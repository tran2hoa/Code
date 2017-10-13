<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('types')){

                Schema::create('types', function (Blueprint $table) {
                    $table->engine = "InnoDB";
                        $table->increments('id');
                        $table->text('name');
                        $table->text('description')->default(NULL);
                        $table->string('slug')->unique();
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
        Schema::dropIfExists('types');
    }
}
