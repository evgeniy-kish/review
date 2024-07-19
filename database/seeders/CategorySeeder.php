<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws JsonException
     */
    public function run()
    {
        Category::truncate();
        Category::flushEventListeners();

        $categories = json_decode(
            file_get_contents(dirname(__DIR__) . '/data/categories.json'),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        DB::table('categories')
            ->insert($categories);
    }
}
