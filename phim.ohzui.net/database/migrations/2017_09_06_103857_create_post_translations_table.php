<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if (!Schema::hasTable('posts_translations')) {
        //     Schema::create('posts_translations', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->integer('posts_id')->unsigned();
        //         $table->string('ttitle');
        //         $table->text('tdescription');
        //         $table->text('tbody');
        //         $table->string('locale')->index();
        //         $table->unique(['posts_id', 'locale']);
        //         $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');
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
        Schema::dropIfExists('post_translations');
    }
}
