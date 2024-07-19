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
        Schema::create('attributes', static function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('category_id');
            $table->string('name');
            $table->enum('type', ['string', 'integer', 'float', 'link']);
            $table->boolean('required');
            $table->json('variants');
            $table->unsignedTinyInteger('sort')->default(30)->index();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
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

        Schema::dropIfExists('attributes');
    }
};
