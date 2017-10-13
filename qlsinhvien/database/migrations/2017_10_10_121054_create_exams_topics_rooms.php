<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTopicsRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams_topics_rooms', function (Blueprint $table) {
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
            $table->integer('rooms_id')->unsigned()->default(0);
            $table->foreign('rooms_id')
                ->references('id')->on('rooms')
                ->onDelete('cascade');
            $table->unique(['exams_id', 'topics_id','rooms_id']);
            $table->smallInteger('room_num')->unsigned();
            $table->integer('max');
            $table->integer('start_time')->unsigned();
            $table->integer('end_time')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('exams_topics_rooms');
    }
}
