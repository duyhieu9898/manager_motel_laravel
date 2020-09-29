<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->string('phone')->nullable();
            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

            //relationship
            $table->foreign('address_id')->references('id')
                ->on('addresses')
                ->onDelete('cascade')
                ->onUpdate('cascade'); //n-1
        });
        //full text search
        DB::statement('ALTER TABLE users ADD FULLTEXT `search` (`email`, `name`)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
