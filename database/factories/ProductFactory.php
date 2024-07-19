<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $categories_id, $number = 0;

        $categories_id ??= Category::where('parent_id', '<>', 0)->pluck('id')->all();

        return [
            'category_id' => $this->faker->randomElement($categories_id),
            'title'       => $title = $this->faker->company(),
            'slug'        => Str::slug($title . '-' . ++$number),
            //'img'         => 'https://picsum.photos/300/300?random=' . $number,
            'img'         => '/img/special/no-image-300x300.png',
            'description' => Str::limit($text = $this->faker->realText(1000), 100, ''),
            'body'        => "<p>{$text}</p>",
            'rating'      => $this->faker->randomElement([1, 2, 3, 4, 5]),
        ];
    }
}
