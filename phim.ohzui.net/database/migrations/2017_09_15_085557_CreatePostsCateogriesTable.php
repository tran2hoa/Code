<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCateogriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if (!Schema::hasTable('tags_translations')) {
        //     Schema::create('tags_translations', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->integer('tags_id')->unsigned();
        //         $table->string('tname');
        //         $table->string('locale')->index();
        //         $table->unique(['tags_id', 'locale']);
        //         $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
        //     });
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags_translations');
    }
}
