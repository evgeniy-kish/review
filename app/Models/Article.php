<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use App\Models\Traits\Likable;
use App\Models\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Article
 *
 * @property int         $id
 * @property int         $rubric_id
 * @property int         $user_id
 * @property string      $title
 * @property string      $slug
 * @property string      $img
 * @property string      $description
 * @property string      $body
 * @property int         $status
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @mixin Eloquent
 * @property-read Rubric    $rubric
 * @property-read User      $user
 * @property-read bool      $is_liked
 * @property-read int       $likes_count
 * @property-read int       $comments_count
 * @property-read Like[]    $likes
 * @property-read Comment[] $comments
 */
class Article extends Model
{
    use HasFactory, SoftDeletes, Likable, Commentable;

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    public static array $status = [
        1 => 'Черновик',
        2 => 'Опубликовано'
    ];

    /**
     * @var string[]
     */
    protected $with = ['rubric'];

    /**
     * @return string|null
     */
    public function getStatusText(): ?string
    {
        return static::$status[$this->status] ?? null;
    }

    public function rubric()
    {
        return $this->belongsTo(Rubric::class, 'rubric_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
