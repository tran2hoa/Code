<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrailersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('trailers')){

                Schema::create('trailers', function (Blueprint $table) {
                    $table->engine = "InnoDB";
                    $table->increments('id');
                    $table->string('title');
                    $table->text('body');
                    $table->string('thumbnail')->default("noImange.png");
                    $table->string('slug')->unique();
                    $table->integer('views')->unsigned()->default(400);
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
        Schema::dropIfExists('trailers');
    }
}
