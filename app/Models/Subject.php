<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subject
 *
 * @property int             $id
 * @property string          $title
 * @property string          $slug
 * @property-read Question[] $questions
 */
class Subject extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'subjects';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title', 'slug'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class, 'subject_id', 'id');
    }
}
