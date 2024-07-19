<?php

namespace Database\Factories;

use Str;
use DateTime;
use Exception;
use App\Models\User;
use App\Models\Rubric;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        static $date, $ids_rubrics, $ids_users, $number = 0;

        $date ??= (new DateTime())->modify('-2 years');
        $ids_rubrics ??= Rubric::all()->pluck('id')->all();
        $ids_users ??= User::all()->pluck('id')->all();

        return [
            'rubric_id'   => $this->faker->randomElement($ids_rubrics),
            'user_id'     => $this->faker->randomElement($ids_users),
            'title'       => $title = $this->faker->realText(40),
            'slug'        => Str::slug($title . '-' . ++$number),
            //'img'         => 'https://picsum.photos/640/480?random=' . $number,
            'img'         => '/img/special/no-image-600x400.png',
            'description' => Str::limit($text = $this->faker->realText(1000), 100, ''),
            'body'        => "<p>{$text}</p>",
            'status'      => 2,
            'created_at'  => $dum = $date->modify('+' . random_int(1, 3) . 'day')
                ->setTime(random_int(6, 23), random_int(0, 59), random_int(0, 59))
                ->format('Y-m-d H:i:s'),
            'updated_at'  => $dum
        ];
    }
}
