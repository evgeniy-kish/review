<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', static function (Blueprint $table) {
            $table->unsignedSmallInteger('id', true);
            $table->unsignedSmallInteger('parent_id');
            $table->string('title');
            $table->string('slug');
            $table->string('icon')->nullable();
            $table->string('description', 300)->default('');
            $table->string('seo_title')->default('');
            $table->string('seo_description', 300)->default('');
            $table->unsignedTinyInteger('sort')->default(30);

            //Indexes
            $table->unique('slug');
            $table->index('parent_id');
            $table->index('sort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
