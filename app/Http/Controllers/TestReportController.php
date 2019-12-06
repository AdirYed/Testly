<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestReportRequest;
use App\TestReport;
use Illuminate\Support\Facades\Auth;

class TestReportController extends Controller
{
    public function index()
    {
        return Auth::user()->testReports()
            ->orderByDesc('id')
            ->with([
                'testReportAnswers.answer',
                'testReportAnswers.question.category',
                'drivingLicenseType',
            ])
            ->get()
            ->map(static function (TestReport $testReport) {
                return $testReport->append(['correct_answers_count', 'success_by_categories']);
            });
    }

    public function store(StoreTestReportRequest $request)
    {
        $validated = $request->validated();

        /** @var TestReport $testReport */
        $testReport = Auth::user()->testReports()->create($validated);

        $testReport->testReportAnswers()->createMany($validated['answers']);

        return response()->json($testReport, 201);
    }
}
