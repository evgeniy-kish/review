<?php

namespace Database\Seeders;

use App\Models\Rubric;
use App\Models\Article;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rubric::truncate();
        Rubric::flushEventListeners();

        Rubric::insert([
            ['title' => 'Общество', 'slug' => 'society'],
            ['title' => 'Экономика', 'slug' => 'economy'],
            ['title' => 'Hi-Tech', 'slug' => 'hi-tech'],
            ['title' => 'Авто', 'slug' => 'auto'],
            ['title' => 'Культура', 'slug' => 'culture'],
            ['title' => 'Здоровье', 'slug' => 'health'],
            ['title' => 'Коронавирус', 'slug' => 'covid-19'],
            ['title' => 'Знаменитости', 'slug' => 'celebrities'],
        ]);

        Article::factory(300)
            ->create();
    }
}
