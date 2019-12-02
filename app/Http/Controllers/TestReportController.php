<?php

namespace App\Http\Controllers;

use App\TestReport;
use Illuminate\Http\Request;

class TestReportController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        return $this->authUser()->testReports;
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'wrong_answers' => 'required|integer',
            'correct_answers' => 'required|integer',
            'started_at' => 'required',
            'finished_at' => 'required',
            'test' => 'required|json',
            'driving_license_type_id' => 'required|integer',
        ]);

        $payload['started_at'] = date("Y-m-d H:i:s", $payload['started_at']/1000);
        $payload['finished_at'] = date("Y-m-d H:i:s", $payload['finished_at']/1000);

        $payload['passed'] = $payload['correct_answers'] >= 28 ? 1 : 0;
        $payload['user_id'] = 2;

        TestReport::create($payload);
    }
}

//             ->select([
//            'user_id', 'driving_license_type_id', 'passed', 'started_at', 'finished_at', 'test',
//        ]);
