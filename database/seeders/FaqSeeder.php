<?php

namespace Database\Seeders;

use App\Models\Subject;
use App\Models\Question;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::truncate();
        Subject::flushEventListeners();

        Subject::insert([
            ['title' => 'Личная информация', 'slug' => 'personal-information'],
            ['title' => 'Личная статистика', 'slug' => 'personal-statistics'],
            ['title' => 'Отзывы', 'slug' => 'reviews'],
            ['title' => 'Сайт для частных специалистов', 'slug' => 'website-for-private-specialists'],
            ['title' => 'Контент', 'slug' => 'content'],
            ['title' => 'Сотрудничество', 'slug' => 'cooperation'],
        ]);

        Question::factory(20)
            ->create();
    }
}
