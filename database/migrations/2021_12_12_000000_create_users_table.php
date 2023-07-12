<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('mobile');
            $table->string('nationcode');
            $table->tinyInteger('gender')->default(0);
            $table->string('code')->unique();
            $table->string('introduced')->nullable();
            $table->tinyInteger('point')->default(5);
            $table->unsignedBigInteger('level_id')->default(1);
            $table->string('password');
            $table->string('verify_code');
            $table->dateTime('verify_expire');
            $table->tinyInteger('verified')->default(0);
            $table->string('token',80)->unique()->nullable();
            $table->softDeletes();
            $table->timestamps();

            //references
            $table->foreign('level_id')
            ->references('id')
            ->on('levels')
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
        Schema::dropIfExists('users');
    }
}
