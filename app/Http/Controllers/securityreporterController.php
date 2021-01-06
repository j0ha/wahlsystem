<?php

namespace App\Http\Controllers;

use App\Securityreport;
use Bugsnag;
use Exception;


class securityreporterController extends Controller
{
    private $electionUUID;

    public function __construct($electionUUID)
    {
        $this->electionUUID = $electionUUID;
    }

    public function report($describtion, $importance, $file, $additional_info, $error)
    {
        try {
            $report = new Securityreport();
            $report->description = $describtion;
            $report->description_h = hash('sha256', $describtion);
            $report->importance = $importance;
            $report->file = $file;
            $report->election_uuid = $this->electionUUID;
            $report->additional_info = $additional_info;
            $report->error = $error;
            $report->save();
        } catch (Exception $e) {
            Bugsnag::notifyException($e);
        }
    }
}
