<?php

namespace App\Http\Livewire;

use App\Http\Controllers\securityreporterController;
use App\Securityreport;
use Livewire\Component;
use Livewire\WithPagination;

class BackendSecurityreporter extends Component
{
    use WithPagination;

    public $perPage = 20;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;

    public $report_id;
    public $report_importance;
    public $report_description;
    public $report_error;
    public $report_file;
    public $report_additional;
    public $report_time;




    public $electionUUID;

    public function mount($electionUUID) {
        $this->electionUUID = $electionUUID;
    }

    public function render()
    {
        return view('livewire.backend-securityreporter', [
            'reports' => Securityreport::search($this->search)
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->simplePaginate($this->perPage),
        ]);
    }

    public function delete($id) {
        $report = Securityreport::find($id);

        if($report->election_uuid == $this->electionUUID) {
           $report->delete();
        } else {
            $securityreporter = new securityreporterController($this->electionUUID);
            $securityreporter->report('tried to delete forbidden security report',3, get_class(),'IP: '. \Request::getClientIp(), null);
        }
    }

    public function downloadList() {

    }

    public function downloadPDF() {

    }

    public function print() {

    }

    public function show($id) {
        $report = Securityreport::find($id);

        if($report->election_uuid == $this->electionUUID) {
            $this->report_id = $report->id;
            $this->report_description = $report->description;
            $this->report_error = $report->error;
            $this->report_file = $report->file;
            $this->report_additional = $report->additional_info;
            $this->report_time = $report->updated_at;
        } else {
            $securityreporter = new securityreporterController($this->electionUUID);
            $securityreporter->report('tried to access forbidden security report',3, get_class(),'IP: '. \Request::getClientIp(), null);
        }

    }

}
