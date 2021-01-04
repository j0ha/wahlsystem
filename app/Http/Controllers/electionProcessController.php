<?php

namespace App\Http\Controllers;

use App\Election;
use App\Voter;
use App\Candidate;
use App\Terminal;
use Bugsnag;


class electionProcessController extends Controller
{
    private $securityreporter;
    protected $electionUUID;
    private $securityController;
    private $terminalController;
    protected $election;
    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
        $this->securityreporter = new securityreporterController($this->electionUUID);
        $this->securityController = new securityController($this->electionUUID);
        $this->terminalController = new terminalController($this->electionUUID);
        $this->election = Election::where('uuid', $this->electionUUID)->firstOrFail();
    }

    /**
     * Durchläuft eine geaue Prüfung der Verschiedenen Atrribute und stellt sicher, dass sie zueinander passen und der Prozess valide ist.
     * @param string $candidateUUID die UUID des Candidaten welcher gewählt werden soll
     * @param string $voterUUID die UUID der Voters
     * @param string $terminalUUID das Terminal über werlches gevoted wird
     * @param string $direct die directUUID asl seperater übertrag des Voters, um zu überprüfen, welcher Vote abgegeben werden muss
     * @return false falls der Vorgang scheitert, sonst NULL
     */
    public function vote(string $candidateUUID, $voterUUID, $terminalUUID, $direct) {
        //Try-Catch-Block um Fehler abzufangen
        try {
            //Entscheidung, welche Verifikation genuztet wird
            if ($this->election->manual_voter_activation == true AND $direct == false) {
                $isallowed = $this->securityController->extendedVoteVerification($voterUUID);
            } else {
                $isallowed = $this->securityController->voteVerification($voterUUID);
            }

          $candidatebelongsto = $this->securityController->verifyToElection('candidate', $candidateUUID);
          $terminalAccess = $this->terminalController->verifyTerminalAcces($this->electionUUID, $terminalUUID);
            //Überprüfung, die drei Bedingungen erfüllt sind, sodass der Vote-Prozess weiter gehen kann
          if($isallowed == true and $candidatebelongsto == true and $terminalAccess == true){

            $terminal = Terminal::where('uuid', $terminalUUID)->firstOrFail();

            $voter = Voter::find(Self::getId($voterUUID, 'voters'));
            //Abfrage, welcher Terminal Typ vorliegt, um zu bestimmen wie der Voter abstimmt
            switch ($terminal->kind) {
              case config('terminalkinds.normal.short'):
                $voter->voted_via_terminal = true;
                $voter->activated = false;
                break;
              case config('terminalkinds.email.short'):
                $voter->voted_via_email = true;
                break;
              default:
                  //Default Fall, welcher flase ausgibt, wenn etwas schief glaufen ist, weil zum Beispiel der Terminal-Tyo gefälscht ist
                  //Security Reporter, welcher die Vorfälle meldet
                Bugsnag::leaveBreadcrumb('worng terminal type was detected at vote function', ['terminalKind'=>$terminal->kind]);
                $this->securityreporter->report('worng terminal type was detected at vote function',1, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID. ' given terminalUUID: '.$terminalUUID.' CandidateUUID: '. $candidateUUID, null);
                return false;
            }
            //Datenpaket des Voters wird gespeichert und die Aufgabe wird an den Vote-Agent übergeben
            $voter->save();
            Self::voteAgent($candidateUUID);
            //Für die Statistik wird ein Hit dem Termninal hinzugefügt
            $this->terminalController->hit($terminalUUID);
          } else {
              //Security Reporter, welcher Sicherheitsvorfälle meldet, dass der Zugang durch die drei Abfragen gescheitert ist
              $this->securityreporter->report('vote failed point 1',3, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID. ' given terminalUUID: '.$terminalUUID.' CandidateUUID: '. $candidateUUID, null);
          }
        } catch (\Exception $e) {
            //Security Reporter, welcher Sicherheitsvorfälle meldet, dass der gesammte Wahl Prozess gescheitert ist
            $this->securityreporter->report('vote failed point 2',3, get_class(),'IP: '. \Request::getClientIp().'given VoterUUID: '. $voterUUID. ' given terminalUUID: '.$terminalUUID.' CandidateUUID: '. $candidateUUID, $e);
            Bugsnag::notifyException($e);
        }

    }

    /**
     * Erfüllt die Aufgabe des Gutstreibens der Stimme für den Kandidaten
     * @param string $candidateUUID die UUID des Kanidaten, welchem eine Stimme gutgeschrieben werden soll
     */
    private function voteAgent($candidateUUID) {
        //Try-Catch Block um Fehler aufzufangen
      try {
        $candidate = Candidate::find(Self::getId($candidateUUID, 'candidates'));
        $candidate->votes = $candidate->votes + 1;
        $candidate->save();

        $this->securityController->safetyTables($candidateUUID);
      } catch (\Exception $e) {
          //Security Reporter, welcher Sicherheitsvorfälle meldet, dass der Vote-Agent gescheitert ist
          $this->securityreporter->report('vote failed point 3',1, get_class(),'CandidateUUID: '. $candidateUUID, $e);
          Bugsnag::notifyException($e);
      }
    }

    public function querryElectionCandidates($electionUUID) {
      try {
        $candidates = Candidate::where('election_id', Self::getId($electionUUID, 'elections'))->get();

        return $candidates;
      } catch (\Exception $e) {
          Bugsnag::notifyException($e);
      }

    }

    public function getId($uuid, $table) {
      try {
        switch ($table) {
          case 'voters':
            return Voter::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'terminals':
            return Terminal::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'elections':
            return Election::where('uuid', $uuid)->firstOrFail()->id;
            break;
          case 'candidates':
            return Candidate::where('uuid', $uuid)->firstOrFail()->id;
            break;
          default:
            return 'error';
            break;
        }
      } catch (\Exception $e) {
          Bugsnag::notifyException($e);
      }
    }
}
