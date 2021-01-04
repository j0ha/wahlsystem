<?php

namespace App\Http\Livewire;

use App\Form;
use App\Schoolclass;
use App\Voter;
use App\Election;
use Illuminate\Support\Str;
use Livewire\Component;


class BackendCreateVoter extends Component
{
    public $voterName;
    public $voterSurname;
    public $voterDate;
    public $voterEmail;
    public $directly;

    public $form;
    public $classes=[];
    public $class;

    public $electionUUID;

    protected $rules = [
        'voterName' => 'required|max:255',
        'voterSurname' => 'required|max:255',
        'voterDate' => 'required|date',
        'voterEmail' => 'required|email',
        'form' => 'required|numeric|exists:forms,id',
        'class' => 'required|numeric|exists:classes,id',

    ];

    public function mount($electionUUID){
        $this->electionUUID = $electionUUID;


    }
    public function render()
    {
        if(!empty($this->form)){
            $this->classes = Schoolclass::where('form_id', $this->form)->get();
        }
        return view('livewire.backend-create-voter')
            ->withForms(Form::where('election_id', Self::electionID($this->electionUUID))->orderBy('name')->get());

    }

    public function submit(){
        $election = Election::where('uuid', $this->electionUUID)->firstOrFail();
        $this->validate();

        $voter = new Voter;

        $voter->surname = $this->voterSurname;
        $voter->surname_h = hash('sha256', $this->voterSurname);
        $voter->name = $this->voterName;
        $voter->name_h = hash('sha256', $this->voterName);
        $voter->birth_year = $this->voterDate;
        $voter->uuid = Str::uuid();
        if($this->directly == 'true') {
            $voter->direct_uuid = Str::uuid();
        }
        $voter->email = $this->voterEmail;
        $voter->election_id = Election::where('uuid', $this->electionUUID)->firstOrFail()->id;
        if(Schoolclass::where('id', $this->class)->firstOrFail()->form_id == $this->form){
            $voter->schoolclass_id = $this->class;
        } else {
            return "Error: The ID's are not correct!";
        }
        $voter->form_id = $this->form;

        if($election->manual_voter_activation == true) {
            $voter->activated = false;
        } else {
            $voter->activated = true;
        }

        $voter->save();

        return redirect()->route('voters.view', ['electionUUID' => $this->electionUUID]);
    }

    public function electionID($electionUUID1){
       $id = Election::where('uuid', $electionUUID1)->firstOrFail()->id;

        return $id;
    }
}
