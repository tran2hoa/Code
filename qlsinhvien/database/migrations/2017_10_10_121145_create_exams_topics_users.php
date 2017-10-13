<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTopicsUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_topics_users', function(Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('exams_id')->unsigned()->default(0);
            $table->foreign('exams_id')
                ->references('id')->on('exams')
                ->onDelete('cascade');
            $table->integer('topics_id')->unsigned()->default(0);
            $table->foreign('topics_id')
                ->references('id')->on('topics')
                ->onDelete('cascade');
            $table->integer('users_id')->unsigned()->default(0);
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->unique(['exams_id', 'topics_id','users_id']);
            $table->integer('sbd')->unsigned();
            $table->integer('room_num')->unsigned();
            $table->string('point');
            $table->boolean('final');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('exams_topics_users');

    }
}
