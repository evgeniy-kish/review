<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

use function count;

/**
 * App\Models\Attribute
 *
 * @property int    $id
 * @property int    $category_id
 * @property string $name
 * @property string $type
 * @property bool   $required
 * @property array  $variants
 * @property int    $sort
 * @mixin Eloquent
 */
class Attribute extends Model
{
    public const TYPE_STRING  = 'string';
    public const TYPE_INTEGER = 'integer';
    public const TYPE_FLOAT   = 'float';
    public const TYPE_LINK    = 'link';

    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'type',
        'required',
        'default',
        'variants',
        'sort'
    ];

    protected $casts = [
        'variants' => 'array',
    ];

    public $timestamps = false;

    public static function typesList(): array
    {
        return [
            self::TYPE_STRING  => 'String',
            self::TYPE_INTEGER => 'Integer',
            self::TYPE_FLOAT   => 'Float',
            self::TYPE_LINK    => 'Link',
        ];
    }

    public function isString(): bool
    {
        return $this->type === self::TYPE_STRING;
    }

    public function isLink(): bool
    {
        return $this->type === self::TYPE_LINK;
    }

    public function isInteger(): bool
    {
        return $this->type === self::TYPE_INTEGER;
    }

    public function isFloat(): bool
    {
        return $this->type === self::TYPE_FLOAT;
    }

    public function isNumber(): bool
    {
        return $this->isInteger() || $this->isFloat();
    }

    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }
}
