<?php

namespace Database\Factories;

use Str;
use App\Models\Subject;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;


    /**
     * @return array
     */
    public function definition(): array
    {
        static $ids_subjects, $number = 0;

        $ids_subjects ??= Subject::all()->pluck('id')->all();

        return [
            'subject_id' => $this->faker->randomElement($ids_subjects),
            'title'       => $name = $this->faker->realText(40),
            'answer'     => $this->faker->realText(40),
            'slug'       => Str::slug($name . '-' . ++$number),
        ];
    }
}
