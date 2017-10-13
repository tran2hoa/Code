<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // if (!Schema::hasTable('categories_translations')) {
        //     Schema::create('categories_translations', function (Blueprint $table) {
        //         $table->increments('id');
        //         $table->integer('categories_id')->unsigned();
        //         $table->string('tname');
        //         $table->text('tdescription');
        //         $table->string('locale')->index();
        //         $table->unique(['categories_id', 'locale']);
        //         $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('categories_translations');
    }
}
