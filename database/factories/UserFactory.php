<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $date, $number = 0;

        return [
            'email'             => $this->faker->unique()->safeEmail(),
            'password'          => '$2y$10$4JfS1ew4o69bvkne8Q2CH.Kq0ydBmBXOivfsAojI6DH912AaMtEIC', //123123
            'name'              => $this->faker->name(),
            //'avatar'            => 'https://picsum.photos/300/300?random=' . ++$number,
            'avatar'            => null,
            'status'            => $this->faker->randomKey(User::$status),
            'role'              => $this->faker->randomKey(User::$roles),
            'remember_token'    => Str::random(10),
            'email_verified_at' => $date ??= now(),
            'created_at'        => $date,
            'updated_at'        => $date,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
