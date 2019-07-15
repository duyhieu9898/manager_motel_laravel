<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('street');
            $table->string('ward_id');
            $table->string('district_id');
            $table->string('province_id');
            //
            $table->index(['province_id','district_id','ward_id']);
            // $table->foreign('ward_id')->references('id')->on('wards')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
