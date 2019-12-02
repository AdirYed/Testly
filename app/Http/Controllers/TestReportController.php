<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestReportRequest;

class TestReportController extends Controller
{
    public function index()
    {
        return auth()->user()->testReports;
    }

    public function store(StoreTestReportRequest $request)
    {
        $payload = $request->validated();

        $payload['passed'] = $payload['correct_answers'] >= 28 ? 1 : 0;

        auth()->user()->testReports()->create($payload);
    }
}

//             ->select([
//            'user_id', 'driving_license_type_id', 'passed', 'started_at', 'finished_at', 'test',
//        ]);
