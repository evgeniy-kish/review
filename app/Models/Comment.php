<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Comment
 *
 * @property int                 $id
 * @property int                 $review_id
 * @property int                 $user_id
 * @property string              $message
 * @property Carbon              $deleted_at
 * @property Carbon              $created_at
 * @property Carbon              $updated_at
 *
 * @mixin Eloquent
 *
 * @property-read Model|Eloquent post
 * @property-read User           $user
 */
class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }
}
