<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('views')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('views');
    }
}
