<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomConvenientTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('room_convenient', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('room_id')->unsigned();
			$table->bigInteger('convenient_id')->unsigned();
			$table->timestamps();
			//
			$table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('convenient_id')->references('id')->on('convenients')->onDelete('cascade')->onUpdate('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('room_convenient');
	}
}
