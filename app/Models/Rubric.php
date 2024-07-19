<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Rubric
 *
 * @property int            $id
 * @property string         $title
 * @property string         $slug
 * @property Carbon|null    $deleted_at
 * @mixin Eloquent
 * @property-read Article[] $articles
 * @property-read int|null  $articles_count
 */
class Rubric extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'rubrics';

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'slug'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;


    public function articles()
    {
        return $this->hasMany(Article::class, 'rubric_id', 'id');
    }
}
