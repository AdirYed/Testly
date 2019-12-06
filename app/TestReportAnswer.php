<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\TestReportAnswer.
 *
 * @property int $id
 * @property int $test_report_id
 * @property int $question_id
 * @property int|null $answer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Answer|null $answer
 * @property-read \App\Question $question
 * @property-read \App\TestReport $testReport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer whereAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer whereQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer whereTestReportId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReportAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TestReportAnswer extends Model
{
    protected $fillable = [
        'test_report_id',
        'question_id',
        'answer_id',
    ];

    public function testReport(): BelongsTo
    {
        return $this->belongsTo(TestReport::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}
