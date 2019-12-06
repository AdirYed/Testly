<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestReportRequest;

class TestReportController extends Controller
{
    public function index()
    {
        return auth()->user()->testReports()->orderByDesc('id')->select([
            'user_id', 'driving_license_type_id', 'started_at', 'finished_at',
        ]);
    }

    public function store(StoreTestReportRequest $request)
    {
        $validated = $request->validated();

        $testReport = auth()->user()->testReports()->create($validated);

        $testReport->answers()->insert($validated['answers']);

        $answers = [];

        foreach ($validated['answers'] as $request) {
            $answers[] = $request;
        }

        $testReport->answers()->insert($answers);
    }
}
