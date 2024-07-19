<?php

namespace App\Models;

use Eloquent;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Like
 *
 * @property int    $id
 * @property int    $user_id
 * @property int    $liked_id
 * @property string $liked_type
 * @property Carbon $created_at
 *
 * @mixin Eloquent
 * @property-read Model|Eloquent $liked
 */
class Like extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function liked()
    {
        return $this->morphTo();
    }
}
