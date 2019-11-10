<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * App\Question
 *
 * @property int $id
 * @property string $title
 * @property string|null $image_url
 * @property int $original_id
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Category $category
 * @property-read \App\Answer $correctAnswer
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DrivingLicenseType[] $drivingLicenseTypes
 * @property-read int|null $driving_license_types_count
 * @property-read mixed $formatted_image_url
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question random()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereOriginalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Question extends Model
{
    protected $fillable = [
        'title',
        'image_url',
        'original_id',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    public function correctAnswer(): HasOne
    {
        return $this->hasOne(Answer::class)->where('is_correct', true);
    }

    public function drivingLicenseTypes(): BelongsToMany
    {
        return $this->belongsToMany(DrivingLicenseType::class);
    }

    public function getCorrectAnswer(): Answer
    {
        if ($this->relationLoaded('answers')) {
            return $this->answers->firstWhere('is_correct', true);
        }

        return $this->answers()->where('is_correct', true)->first();
    }

    public function getFormattedImageUrlAttribute(): ?string
    {
        if ($this->image_url === null) {
            return null;
        }

        if (Storage::exists("storage/{$this->image_url}")) {
            return Storage::url("storage/{$this->image_url}");
        }

        return $this->image_url;
    }

    public function scopeRandom(Builder $query): void
    {
        $query->select(['id', 'title', 'image_url'])
            ->with([
                'answers' => static function (HasMany $answersQuery) {
                    $answersQuery->select(['id', 'question_id', 'content', 'is_correct'])->inRandomOrder();
                }
            ])
            ->limit(30)
            ->inRandomOrder();
    }
}
