<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', static function (Blueprint $table) {
            $table->id();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('name', 100);
            $table->string('avatar', 300)->nullable();
            $table->unsignedTinyInteger('status')->default(4)->index();
            $table->unsignedTinyInteger('role')->default(1)->index();
            $table->integer('balance')->default(0);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->string('google_id')->nullable()->index();
            $table->string('vk_id')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('users');
    }
};
