<?php

namespace App\Models\Traits;

use App\Models\Like;

trait Likable
{
    protected static function bootLikable()
    {
        static::deleting(static fn($model) => $model->likes->each->delete());
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'liked');
    }

    public function like()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->likes()->where($attributes)->exists()) {
            $this->likes()->create($attributes);
        }

        return true;
    }

    public function unlike()
    {
        $attributes = ['user_id' => auth()->id()];

        //$this->favorites()->where($attributes)->get()->each->delete();
        if ($this->likes()->where($attributes)->exists()) {
            return $this->likes()->where($attributes)->delete();
        }

        return true;
    }

    public function isLiked()
    {
        return (bool)$this->likes()->where('user_id', auth()->id())->count();
    }

    public function getIsLikedAttribute()
    {
        return $this->isLiked();
    }
}
