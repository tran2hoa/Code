<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('info_profiles')) {
            Schema::create('info_profiles', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('info_id')->unsigned()->default(0);
                $table->foreign('info_id')
                    ->references('id')->on('info')
                    ->onDelete('cascade');
                $table->integer('profiles_id')->unsigned()->default(0);
                $table->foreign('profiles_id')
                    ->references('id')->on('profiles')
                    ->onDelete('cascade');
                $table->unique(['info_id', 'profiles_id']);
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
        Schema::dropIfExists('info_profiles');
    }
}
