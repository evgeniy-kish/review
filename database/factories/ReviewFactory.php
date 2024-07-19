<?php

namespace Database\Factories;

use DateTime;
use Exception;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition()
    {
        static $date, $ids_products = [1], $ids_users;

        $date ??= (new DateTime())->modify('-2 years');
        $ids_users ??= User::all()->pluck('id')->all();

        return [
            'user_id'    => $this->faker->randomElement($ids_users),
            'product_id' => $this->faker->randomElement($ids_products),
            'rating'     => $this->faker->randomElement([1, 2, 3, 4, 5]),
            'body'       => $this->faker->realText(500),
            'activity'   => 0,
            'created_at' => $dum = $date->modify('+' . random_int(1, 300) . 'minute')
                ->setTime(random_int(6, 23), random_int(0, 59), random_int(0, 59))
                ->format('Y-m-d H:i:s'),
            'updated_at' => $dum
        ];
    }
}
