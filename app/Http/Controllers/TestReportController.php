<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestReportRequest;
use App\TestReport;
use Illuminate\Support\Facades\Auth;

class TestReportController extends Controller
{
    public function index()
    {
        $count = 0;

        return Auth::user()->testReports()
            ->select(['id', 'started_at', 'finished_at', 'uuid', 'driving_license_type_id'])
            ->orderByDesc('id')
            ->with([
                'testReportAnswers.answer',
                'testReportAnswers.question.category',
                'drivingLicenseType:id,code,name,icon',
            ])
            ->get()
            ->map(static function (TestReport $testReport) use (&$count) {
                if ($count >= 5 || $testReport->drivingLicenseType->code === 'A3') {
                    return $testReport->append(['correct_answers_count']);
                }

                $count++;

                return $testReport->append(['correct_answers_count', 'success_by_categories']);
            });
    }

    public function preview(string $uuid)
    {
        $testReport = Auth::user()
            ->testReports()
            ->whereUuid($uuid)
            ->select(['id', 'started_at', 'finished_at', 'driving_license_type_id'])
            ->with([
                    'testReportAnswers:id,test_report_id,question_id,answer_id',
                    'testReportAnswers.question:id,title,image_url',
                    'testReportAnswers.question.answers:id,question_id,content,is_correct'
                ])
            ->first();


        if (! $testReport) {
            return response()->json(['error' => 'uuid'], 422);
        }

        foreach ($testReport->testReportAnswers as $testReportAnswer) {
            $testReportAnswer->question->append('formatted_image_url');
        }

        return $testReport;
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
