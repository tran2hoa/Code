<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CcreateInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('infos')){
            Schema::create('infos', function (Blueprint $table) {
                $table->engine = "InnoDB";
                $table->increments('id');
                $table->integer('posts_id')->unsigned()->default(0);
                $table->foreign('posts_id')
                  ->references('id')->on('posts')
                  ->onDelete('cascade');
                $table->unique('posts_id');
                $table->string('thumbnail')->default("noImange.png");
                $table->boolean('status'); // tinh trang phim danh cho phim bo
                $table->string('imdb'); //diem IMDB
                $table->integer('countries_id')->unsigned()->default(0); // quoc gia san xuat
                $table->foreign('countries_id')
                    ->references('id')->on('countries')
                    ->onDelete('cascade');
                $table->integer('years_id')->unsigned()->default(0); //nam san xuat phim
                $table->foreign('years_id')
                    ->references('id')->on('years')
                    ->onDelete('cascade');
                $table->integer('languages_id')->unsigned()->default(0); //ngon ngu phim, viet sub , long tieng, ...
                $table->foreign('languages_id')
                    ->references('id')->on('languages')
                    ->onDelete('cascade');
                $table->string('date'); // ngay chieu
                $table->string('trailer')->default("NULL");
                $table->string('time'); // thoi luong phim
                $table->string('quality'); // chat luong hd full hd
                $table->string('Resolution'); //do phan giai ex 720 1028
                $table->integer('views')->unsigned()->default(400);
                 $table->integer('rate')->unsigned()->default(5);
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
        Schema::dropIfExists('infos');
    }
}
