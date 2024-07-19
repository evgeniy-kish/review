<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Models\User
 *
 * @property int                  $id
 * @property string               $email
 * @property string               $password
 * @property string               $name
 * @property string               $avatar
 * @property int                  $status
 * @property int                  $role
 * @property int                  $balance
 * @property Carbon               $created_at
 * @property Carbon               $updated_at
 * @property string|null          $remember_token
 * @property Carbon|null          $email_verified_at
 * @mixin Eloquent
 * @property-read Article[]       $articles
 * @property-read Product[]       $products
 * @property-read Review[]        $reviews
 * @property-read Comment[]       $comments
 * @property-read BalanceStream[] $balances
 * @property-read Order[]         $orders
 * @property-read int|null        $articles_count
 * @property-read int|null        $products_count
 * @property-read int|null        $reviews_count
 * @property-read int|null        $comments_count
 * @property-read int|null        $orders_count
 * @property-read int|null        $balances_sum_charge
 * @property-read int             $hold
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'users';

    /**
     * @var string[]
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string
     */
    public static string $default_avatar = '/img/bg-img/sb1.jpg';

    /**
     * @var string[]
     */
    public static array $status = [
        0 => 'Бан',
        1 => 'Временный бан',
        2 => 'Не активный',
        3 => 'На модерации',
        4 => 'Активный'
    ];

    /**
     * @var string[]
     */
    static public $roles = [
        1 => 'Пользователь',
        2 => 'Представитель',
        3 => 'Модератор',
        4 => 'Администратор'
    ];

    /**
     * @var int|null
     */
    protected ?int $holding = null;

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role > 3;
    }

    /**
     * @return bool
     */
    public function isModerator(): bool
    {
        return $this->role > 2;
    }

    /**
     * @return string|null
     */
    public function roleName(): string|null
    {
        return static::$roles[$this->role] ?? null;
    }

    /**
     * @return string
     */
    public function firstLetter(): string
    {
        return mb_strtoupper(mb_substr($this->name, 0, 1));
    }

    /**
     * @return int
     */
    public function realBalance(): int
    {
        return $this->balance + $this->hold;
    }

    /**
     * @return Attribute
     */
    protected function hold(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->holding ??= $this
                    ->orders()
                    ->ofType([Order::STATUS['NEW'], Order::STATUS['PENDING']])
                    ->sum('amount');
            },
        );
    }

    /**
     * @return HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function balances()
    {
        return $this->hasMany(BalanceStream::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    /**
     * @return bool
     */
    public function isDefaultAvatar(): bool
    {
        return $this->avatar === static::$default_avatar;
    }

    /**
     * @return Attribute
     */
    protected function avatar(): Attribute
    {
        return Attribute::make(
            get: static fn($value) => $value ?: static::$default_avatar,
        );
    }
}
