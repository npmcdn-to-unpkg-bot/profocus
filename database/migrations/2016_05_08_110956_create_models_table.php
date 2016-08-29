<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->tinyInteger('bust',false,true);
            $table->tinyInteger('waist',false,true);
            $table->tinyInteger('hips',false,true);
            $table->tinyInteger('dress',false,true);
            $table->tinyInteger('shoe',false,true);
            $table->string('hair',50);
            $table->string('eyes',50);
            $table->text('about');
            $table->string('thumbnail');
            $table->string('thumbnail_wide');
            $table->tinyInteger('portfolio_id',false,true);
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
        Schema::drop('models');
    }
}
