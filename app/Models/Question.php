<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Question
 *
 * @property int    $id
 * @property int    $subject_id
 * @property string $title
 * @property string $answer
 * @property string $slug
 */
class Question extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'questions';

    /**
     * @var string[]
     */
    protected $fillable = [
        'subject_id', 'title', 'answer', 'slug'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
}
