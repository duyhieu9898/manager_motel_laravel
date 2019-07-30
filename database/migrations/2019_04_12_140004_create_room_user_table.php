<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('room_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('room_id')->unsigned();
            $table->integer('peoples');
            $table->timestamp('arrival_date')->nullable();
            $table->timestamp('departure_date')->nullable();
            $table->bigInteger('status_id')->unsigned()->default(1);
            $table->timestamps();
            //relationship
            $table->foreign('user_id')->references('id')
                        ->on('users')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('room_id')->references('id')
                        ->on('rooms')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
            $table->foreign('status_id')->references('id')
                        ->on('status_bookings')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_user');
    }
}
