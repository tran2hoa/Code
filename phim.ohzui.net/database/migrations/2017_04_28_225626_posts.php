<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('posts')) {
            Schema::create('posts', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('author_id')->unsigned()->default(0);
                $table->foreign('author_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
                $table->string('title');
                $table->text('body');
                $table->string('video')->default("");
                $table->string('slug')->unique();
                $table->enum('type', ['series','single','trailer'])->default('single');
                $table->boolean('active');
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
        // drop blog table
        Schema::drop('posts');
    }
}
