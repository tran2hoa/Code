<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostsTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts_tags')) {
            Schema::create('posts_tags', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('posts_id')->unsigned()->default(0);
                $table->foreign('posts_id')
                    ->references('id')->on('posts')
                    ->onDelete('cascade');
                $table->integer('tags_id')->unsigned()->default(0);
                $table->foreign('tags_id')
                    ->references('id')->on('tags')
                    ->onDelete('cascade');
                $table->unique(['tags_id', 'posts_id']);
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
        Schema::dropIfExists('posts_tags');

    }
}
