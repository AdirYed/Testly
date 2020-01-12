<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use function foo\func;

/**
 * App\TestReport
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon $started_at
 * @property \Illuminate\Support\Carbon $finished_at
 * @property string $token
 * @property int|null $user_id
 * @property int $driving_license_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\DrivingLicenseType $drivingLicenseType
 * @property-read int $correct_answers_count
 * @property-read array $success_by_categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TestReportAnswer[] $testReportAnswers
 * @property-read int|null $test_report_answers_count
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereDrivingLicenseTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereFinishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\TestReport whereUserId($value)
 * @mixin \Eloquent
 */
class TestReport extends Model
{
    protected $fillable = [
        'started_at',
        'finished_at',
        'user_id',
        'driving_license_type_id',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->uuid = Str::uuid()->toString();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function drivingLicenseType(): BelongsTo
    {
        return $this->belongsTo(DrivingLicenseType::class);
    }

    public function testReportAnswers(): HasMany
    {
        return $this->hasMany(TestReportAnswer::class);
    }

    /**
     * Count how many correct answers this test report has.
     *
     * @return int
     */
    public function getCorrectAnswersCountAttribute(): int
    {
        return $this->testReportAnswers->where('answer.is_correct', true)->count();
    }

    /**
     * Calculate this test report success by each category.
     *
     * @return array
     */
    public function getSuccessByCategoriesAttribute(): array
    {
        $successByCategories = [];

        $this->testReportAnswers->each(static function (TestReportAnswer $testReportAnswer) use (&$successByCategories) {
            $category_id = $testReportAnswer->question->category_id;
            if (! isset($successByCategories[$category_id])) {
                $successByCategories[$category_id] = [
                    'questions_count' => 0,
                    'correct_answers' => 0,
                ];
            }

            $successByCategories[$category_id]['questions_count'] += 1;

            if ($testReportAnswer->answer !== null && $testReportAnswer->answer->is_correct) {
                $successByCategories[$category_id]['correct_answers'] += 1;
            }
        });

        foreach ($successByCategories as &$category) {
            $category['percent'] = $category['correct_answers'] / $category['questions_count'] * 100;
        }

        return $successByCategories;
    }
}
