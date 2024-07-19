<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Value
 *
 * @property int    $product_id
 * @property int    $attribute_id
 * @property string $value
 * @mixin Eloquent
 */
class Value extends Model
{
    protected $table = 'product_values';

    protected $fillable = [
        'attribute_id',
        'value'
    ];

    public $timestamps = false;
}
