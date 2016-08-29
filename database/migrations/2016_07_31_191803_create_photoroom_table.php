<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoroomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photoroom', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->dateTime('date');
            $table->string('photographer',50);
            $table->string('location',100);
            $table->string('makeup',50);
            $table->string('hair',50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('photoroom');
    }
}
