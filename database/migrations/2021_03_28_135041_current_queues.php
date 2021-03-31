<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Currentqueues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currentqueues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fixed_capacity');
            $table->integer('average_time');
            $table->string('password_verification');
            $table->timestamps();

            //foreing key
            $table->foreign('commerce_id')->references('id')->on('commerces')->onDelete('CASCADE');
            $table->unsignedInteger('commerce_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
