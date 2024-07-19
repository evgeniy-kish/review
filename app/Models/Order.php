<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         $id
 * @property int         $user_id
 * @property int         $amount
 * @property string      $info
 * @property string      $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @mixin Eloquent
 * @property-read User   $user
 * @property-read string $status_text
 * @property-read string $amount_format
 * @method Builder ofType(mixed $type)
 */
class Order extends Model
{
    public const STATUS = [
        'NEW'      => 'new',
        'PENDING'  => 'pending',
        'ACCEPTED' => 'accepted',
        'REJECTED' => 'rejected'
    ];

    /**
     * @var string
     */
    protected $table = 'orders';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return void
     */
    protected static function booted()
    {
        static::updated(static function (Order $order) {
            if ($order->isClose()) {
                $user = $order->user;
                $user->update(['balance' => $user->balance + $order->amount]);

                if ($order->status === Order::STATUS['ACCEPTED']) {
                    $user
                        ->balances()
                        ->create([
                            'charge'  => -$order->amount,
                            'current' => $user->realBalance() - $order->amount,
                            'type'    => BalanceStream::TYPES['ORDER'],
                            'reason'  => $order->id
                        ]);
                }
            }
        });
    }

    /**
     * Типы статусов
     *
     * @return string[]
     */
    public static function statusList(): array
    {
        return [
            static::STATUS['NEW']      => 'Новый',
            static::STATUS['PENDING']  => 'В обработке',
            static::STATUS['ACCEPTED'] => 'Исполнен',
            static::STATUS['REJECTED'] => 'Отклонен',
        ];
    }

    /**
     * @return bool
     */
    public function isOpen(): bool
    {
        return in_array($this->status, [static::STATUS['NEW'], static::STATUS['PENDING']], true);
    }

    /**
     * @return bool
     */
    public function isClose(): bool
    {
        return !$this->isOpen();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @param Builder      $query
     * @param string|array $type
     *
     * @return Builder
     */
    public function scopeOfType(Builder $query, string|array $type)
    {
        return $query->whereIn('status', (array)$type);
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function statusText(): Attribute
    {
        return Attribute::make(get: static fn(
            $value,
            $attributes
        ) => static::statusList()[$attributes['status']] ?? '');
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function amountFormat(): Attribute
    {
        return Attribute::make(get: static fn(
            $value,
            $attributes
        ) => number_format((float)$attributes['amount'], 0, '', ' '));
    }
}
