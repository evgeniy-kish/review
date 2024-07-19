<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use App\Models\Traits\Likable;
use App\Models\Traits\Commentable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Review
 *
 * @property int            $id
 * @property int            $user_id
 * @property int            $product_id
 * @property int            $rating
 * @property string         $body
 * @property string         $short_text
 * @property int            $activity
 * @property Carbon|null    $created_at
 * @property Carbon|null    $updated_at
 *
 * @mixin Eloquent
 * @property-read Product   $product
 * @property-read User      $user
 * @property-read bool      $is_liked
 * @property-read int       $likes_count
 * @property-read int       $comments_count
 * @property-read Like[]    $likes
 * @property-read Comment[] $comments
 */
class Review extends Model
{
    use HasFactory, Likable, Commentable;

    public const STATUS = [
        'MODERATION' => 0,
        'ACTIVE'     => 1
    ];

    public const PRICE = 5;

    protected $casts = [
        'created_at' => 'datetime:d.m.Y'
    ];

    protected $guarded = [];

    public static function statusList(): array
    {
        return [
            static::STATUS['MODERATION'] => 'На модерации',
            static::STATUS['ACTIVE']     => 'Активный'
        ];
    }

    /**
     * @return bool
     */
    public function isActivity(): bool
    {
        return $this->activity === static::STATUS['ACTIVE'];
    }

    public function statusText()
    {
        return static::statusList()[$this->activity] ?? null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return Attribute
     */
    protected function shortText(): Attribute
    {
        return Attribute::make(
            get: static fn($value, $attributes) => str(strip_tags($attributes['body']))->limit(300),
        );
    }
}
