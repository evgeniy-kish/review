<?php

namespace App\Models\Traits;

use App\Models\Comment;

trait Commentable
{
    protected static function bootCommentable()
    {
        static::deleting(static fn($model) => $model->comments->each->delete());
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'post')
            ->whereNull('parent_id')
            ->latest('id');
    }
}
