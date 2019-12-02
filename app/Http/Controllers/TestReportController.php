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

        auth()->user()->testReports()->create($payload);
    }
}
