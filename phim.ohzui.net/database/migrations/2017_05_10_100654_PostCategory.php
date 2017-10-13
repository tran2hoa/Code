<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts_categories')) {
            Schema::create('posts_categories', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('posts_id')->unsigned()->default(0);
                $table->foreign('posts_id')
                    ->references('id')->on('posts')
                    ->onDelete('cascade');

                $table->integer('categories_id')->unsigned()->default(0);
                $table->foreign('categories_id')
                    ->references('id')->on('categories')
                    ->onDelete('cascade');
                $table->unique(['categories_id', 'posts_id']);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts_categories');
    }
}
