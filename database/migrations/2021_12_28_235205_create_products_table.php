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
        Schema::create('products', static function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('category_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('img')->nullable();
            $table->string('description', 500)->default('');
            $table->text('body');
            $table->unsignedFloat('rating', 3)->default(0.00);
            $table->unsignedTinyInteger('reviews_mod')->default(0);
            $table->timestamp('premium_at')->nullable()->index();
            $table->boolean('actual')->default(0)->index();
            $table->softDeletes();
            $table->timestamp('created_at')->nullable()->index();
            $table->timestamp('updated_at')->nullable();

            // Index
            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->index('title');
            $table->unique('slug');
            $table->index('rating');
        });

        Schema::create('product_values', static function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedInteger('attribute_id');
            $table->string('value');
            $table->primary(['product_id', 'attribute_id']);

            // Index
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreign('attribute_id')
                ->references('id')
                ->on('attributes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('product_photos', static function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('product_id');
            $table->string('path');

            // Index
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
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

        Schema::dropIfExists('product_photos');
        Schema::dropIfExists('product_values');
        Schema::dropIfExists('products');
    }
};
