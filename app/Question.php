<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Question.
 *
 * @property int                                                    $id
 * @property string                                                 $title
 * @property string|null                                            $image
 * @property int                                                    $category_id
 * @property \Illuminate\Support\Carbon|null                        $created_at
 * @property \Illuminate\Support\Carbon|null                        $updated_at
 * @property \Illuminate\Database\Eloquent\Collection|\App\Answer[] $answers
 * @property int|null                                               $answers_count
 * @property \App\Category                                          $category
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereUpdatedAt($value)
 * @mixin \Eloquent
 *
 * @property string|null $image_url
 * @property int         $original_id
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereImageUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Question whereOriginalId($value)
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

    public function getCorrectAnswer(): Answer
    {
        if ($this->relationLoaded('answers')) {
            return $this->answers->firstWhere('is_correct', true);
        }

        return $this->answers()->where('is_correct', true)->first();
    }

    public static function randomQuestionWithAnswers() : Collection
    {
        return Question::select(['id', 'title', 'image_url'])->with('answers:id,question_id,content')->limit(30)->inRandomOrder()->get();
    }
}
