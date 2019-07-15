<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->bigInteger('status_booking_id')->unsigned()->default(1);
            $table->string('title');
            $table->text('description');
            $table->bigInteger('room_area')->unsigned();
            $table->integer('maximum_peoples_number')->unsigned()->default(1);
            $table->text('police_and_terms');
            $table->bigInteger('price')->unsigned();
            $table->timestamps();
            //relationship
            $table->foreign('status_booking_id')->references('id')->on('status_bookings')->onDelete('cascade')->onUpdate('cascade'); //1-n
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade')->onUpdate('cascade'); //n-1
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade')->onUpdate('cascade'); //n-1
        });

        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id')->increment();
            $table->string('original_name');
            $table->string('file_name');
            $table->string('slug');
            $table->unsignedBigInteger('room_id')->nullable();
            //relationship
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade'); //n-1
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
        Schema::dropIfExists('rooms');
    }
}
