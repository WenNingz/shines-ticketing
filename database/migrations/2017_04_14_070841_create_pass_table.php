<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePassTable extends Migration
{
    public function up()
    {
        Schema::create('pass', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->unique()->nullable();
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->decimal('price', 8, 2)->default(0);
            $table->dateTime('used_on')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pass');
    }
}
