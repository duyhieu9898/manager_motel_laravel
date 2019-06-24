<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		//
		Schema::create('address', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('apartment_number')->nullable();
			$table->string('street')->nullable();
			$table->string('ward')->nullable();
			$table->string('district')->nullable();
			$table->string('provincial');
			$table->string('country')->default("việt nam");
			$table->bigInteger('address_id')->unsigned();
			$table->string('address_type');
			//
			$table->index('provincial');
			//
			$table->foreign('address_id')->references('id')->on('rooms')->onDelete('cascade')->onUpdate('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('address');
	}
}
