<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->string('birthday',10);
            $table->string('person_id',12);
            $table->string('birthplace');
            $table->string('phone',12);
            $table->text('address');
            $table->string('student_code');
            $table->string('student_class');
            $table->enum('type',['student','other'])->default('student');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profiles');
    }
}
