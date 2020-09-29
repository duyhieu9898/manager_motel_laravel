<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvenienceRoomTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenience_room', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('room_id')->unsigned();
            $table->bigInteger('convenience_id')->unsigned();
            $table->timestamps();
            //
            $table->index(['room_id', 'convenience_id']);
            //relationship
            $table->foreign('room_id')->references('id')
                ->on('rooms')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('convenience_id')->references('id')
                ->on('conveniences')
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
        Schema::dropIfExists('convenience_room');
    }
}
