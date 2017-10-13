<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('profiles')) {
            Schema::create('profiles', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->text('name');
                $table->string('birthday');
                $table->integer('countries_id')->unsigned()->default(0);
                $table->foreign('countries_id')
                    ->references('id')->on('countries')
                    ->onDelete('cascade');
                $table->text('description')->default(NULL);
                $table->string('slug')->unique();
                $table->enum('type', ['actor', 'director'])->default('actor');
                $table->integer('views')->unsigned()->default(10);
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
        Schema::dropIfExists('profiles');
    }
}
