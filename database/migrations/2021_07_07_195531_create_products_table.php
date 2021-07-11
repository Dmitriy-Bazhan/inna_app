<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned()->nullable();
            $table->string('vendor_code', 20)->nullable()->unique();
            $table->string('alias');
            $table->string('search_string')->default(''); //Поисковая строка. Состоит из укр и ру названия товара. Пример ковер_ковдра. Через _. Все символы в нижний регистр.
            $table->integer('price')->default(0);
            $table->string('image_big')->nullable();
            $table->string('image_small')->nullable();
            $table->string('additional_images')->nullable(); //в строчку(serialize or JSON) массив из urls изображений
            $table->tinyInteger('published')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
