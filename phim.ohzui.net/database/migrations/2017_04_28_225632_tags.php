<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tags')) {
            Schema::create('tags', function (Blueprint $table){
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->text('name');
                $table->string('slug');
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
    // drop tags table
   Schema::dropIfExists('tags');
  }
}
