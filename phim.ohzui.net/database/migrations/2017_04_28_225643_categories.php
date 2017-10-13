<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Categories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->text('name');
                $table->text('description')->default(NULL);
                $table->string('slug')->unique();
                $table->integer('parent_id')->unsigned()->default(0);;
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
    // drop categories table
   Schema::drop('categories');
  }
}
