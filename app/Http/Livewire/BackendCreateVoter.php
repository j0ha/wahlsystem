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

    public $form;
    public $classes=[];
    public $class;

    public $electionUUID;

    protected $rules = [
        'voterName' => 'required|max:255',
        'voterSurname' => 'required|max:255',
        'voterDate' => 'required|date',
        'voterEmail' => 'required|email',
        'form' => 'numeric|exists:forms,id',
        'class' => 'numeric|exists:classes,id',

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
            ->withForms(Form::orderBy('name')->get());

    }

    public function submit(){
        $this->validate();

        $voter = new Voter;

        $voter->surname = $this->voterSurname;
        $voter->name = $this->voterName;
        $voter->birth_year = $this->voterDate;
        $voter->uuid = Str::uuid();
        $voter->direct_uuid = Str::uuid();
        $voter->email = $this->voterEmail;
        $voter->election_id = Election::where('uuid', $this->electionUUID)->firstOrFail()->id;
        if(Schoolclass::where('id', $this->class)->firstOrFail()->form_id == $this->form){
            $voter->schoolclass_id = $this->class;
        } else {
            return "Error: The ID's are not correct!";
        }
        $voter->form_id = $this->form;

        $voter->save();

        return redirect()->route('voters.view', ['electionUUID' => $this->electionUUID]);
    }
}
