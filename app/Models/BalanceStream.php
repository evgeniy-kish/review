<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property int         $id
 * @property int         $user_id
 * @property int         $charge
 * @property int         $current
 * @property string      $type
 * @property string      $reason
 * @property Carbon      $created_at
 *
 * @mixin Eloquent
 * @property-read User   $user
 * @property-read string $type_text
 * @property-read string $charge_format
 * @property-read string $current_format
 */
class BalanceStream extends Model
{
    public const TYPES = [
        'REVIEW'  => 'review',
        'ORDER'   => 'order',
        'CORRECT' => 'correct'
    ];

    /**
     * @var string
     */
    protected $table = 'balances_stream';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var string[]
     */
    protected $casts = [
        'created_at' => 'datetime'
    ];

    /**
     * @return void
     */
    protected static function booted()
    {
        static::created(static function (BalanceStream $stream) {
            $stream
                ->user()
                ->update([
                    //'balance' => $stream->user->loadSum('balances', 'charge')->balances_sum_charge
                    'balance' => $stream->user->balance + $stream->charge
                ]);
        });
    }

    /**
     * Типы записей
     *
     * @return string[]
     */
    public static function typesList(): array
    {
        return [
            static::TYPES['REVIEW']  => 'Отзыв',
            static::TYPES['ORDER']   => 'Вывод',
            static::TYPES['CORRECT'] => 'Корректировка',
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * @return int
     */
    public function baldur(): int
    {
        return (int)($this->charge > 0);
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function typeText(): Attribute
    {
        return Attribute::make(get: static fn(
            $value,
            $attributes
        ) => static::typesList()[$attributes['type']] ?? '');
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function chargeFormat(): Attribute
    {
        return Attribute::make(get: static fn(
            $value,
            $attributes
        ) => number_format((float)$attributes['charge'], 0, '', ' '));
    }

    /**
     * @return Attribute
     * @noinspection PhpUnused
     */
    protected function currentFormat(): Attribute
    {
        return Attribute::make(get: static fn(
            $value,
            $attributes
        ) => number_format((float)$attributes['current'], 0, '', ' '));
    }

    /**
     * @return string|null
     */
    public function typeData()
    {
        $method = "{$this->type}Transform";

        return method_exists($this, $method) ? $this->{$method}() : null;
    }

    /**
     * @return string
     */
    protected function reviewTransform()
    {
        $data = explode('|||', $this->reason);

        return '<a href="' . route('review.show', $data[1]) . '">' . $data[0] . '</a>';
    }

    /**
     * @return string
     */
    protected function orderTransform()
    {
        return "Order #{$this->reason}";
    }

    /**
     * @return string
     */
    protected function correctTransform()
    {
        return $this->reason;
    }
}
