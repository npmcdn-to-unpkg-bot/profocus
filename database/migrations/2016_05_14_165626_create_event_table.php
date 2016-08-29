<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->string('phone',13);
            $table->string('email',50);
            $table->text('note');
            $table->tinyInteger('discount');
            $table->tinyInteger('price');
            $table->enum('state',['reserv','soldev']);
            $table->tinyInteger('month');
            $table->tinyInteger('day');
            $table->smallInteger('year');
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
        Schema::drop('event');
    }
}
