<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharacteristicDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characteristic_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('characteristic_id')->unsigned()->nullable();
            $table->string('lang');
            $table->text('content');
            $table->timestamps();

            $table->foreign('characteristic_id')->references('id')->on('characteristics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characteristic_data');
    }
}
