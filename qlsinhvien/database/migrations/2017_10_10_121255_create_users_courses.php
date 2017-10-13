<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_courses',function(Blueprint $table){
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('users_id')->unsigned()->default(0);
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->integer('courses_id')->unsigned()->default(0);
            $table->foreign('courses_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');
            $table->unique(['users_id', 'courses_id']);
            $table->smallInteger('date_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('users_courses');

    }
}
