<?php

namespace Database\Seeders;

use JsonException;
use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws JsonException
     */
    public function run()
    {
        Attribute::truncate();
        Attribute::flushEventListeners();

        $attributes = json_decode(
            file_get_contents(dirname(__DIR__) . '/data/attributes.json'),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        DB::table('attributes')
            ->insert($attributes);
    }
}
