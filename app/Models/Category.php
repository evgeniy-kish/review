<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Category
 *
 * @property int              $id
 * @property int              $parent_id
 * @property string           $title
 * @property string           $slug
 * @property string|null      $icon
 * @property string           $description
 * @property string           $seo_title
 * @property string           $seo_description
 * @property int              $sort
 * @mixin Eloquent
 * @property-read int|null    $children_count
 * @property-read int|null    $products_count
 * @property-read Category[]  $children
 * @property-read Category    $parent
 * @property-read Product[]   $products
 * @property-read Attribute[] $attributes
 * @method static Builder|Category sorted()
 */
class Category extends Model
{
    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Получаем дерево категорий
     *
     * @return array
     */
    public static function getTreeCategories(): array
    {
        $categories = parent::all(['id', 'parent_id', 'title'])
            ->keyBy('id')
            ->toArray();

        $tree = [];

        foreach ($categories as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
                continue;
            }
            $categories[$node['parent_id']]['children'][$node['id']] = &$node;
        }

        unset($node);

        return $tree;
    }

    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parentAttributes(): array
    {
        return $this->parent ? $this->parent->allAttributes() : [];
    }

    /**
     * @return Attribute[]
     */
    public function allAttributes(): array
    {
        //return $this->attributes()->orderBy('sort')->getModels();
        return array_merge($this->parentAttributes(), $this->attributes()->orderBy('sort')->getModels());
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id', 'id');
    }

    public function scopeSorted(Builder $query)
    {
        return $query->orderBy('sort');
    }
}
