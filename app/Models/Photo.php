<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Photo
 *
 * @property int    $id
 * @property int    $product_id
 * @property string $path
 * @mixin Eloquent
 */
class Photo extends Model
{
    protected $table = 'product_photos';

    public $timestamps = false;

    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
