<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::flushEventListeners();

        DB::table('users')
            ->insert([
                'email'             => 'admin@admin.com',
                'password'          => '$2y$10$4JfS1ew4o69bvkne8Q2CH.Kq0ydBmBXOivfsAojI6DH912AaMtEIC', //123123
                'name'              => 'Вася Пупкин',
                'status'            => 4,
                'role'              => 4,
                'email_verified_at' => now(),
                'created_at'        => $date = date('Y-m-d H:i:s'),
                'updated_at'        => $date,
            ]);

        //User::factory(30)->create();
    }
}
