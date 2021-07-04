<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('post_id')->unsigned()->nullable();
            $table->string('lang');
            $table->string('title');
            $table->integer('views')->default(0);
            $table->integer('good_rang')->default(0);
            $table->integer('bad_rang')->default(0);
            $table->text('short_description');
            $table->text('content');
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_data');
    }
}
