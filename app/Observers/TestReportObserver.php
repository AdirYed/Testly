<?php

namespace App\Observers;

use App\TestReport;

class TestReportObserver
{
    public function creating(TestReport $testReport)
    {
        $testReport->passed = $testReport->correct_answers >= 28;
    }
}
