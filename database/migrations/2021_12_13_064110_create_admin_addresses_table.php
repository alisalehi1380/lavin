<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('provance_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('postalCode')->nullable();
            $table->string('address')->nullable();
            $table->timestamps();

            //references
            $table->foreign('admin_id')
            ->references('id')
            ->on('admins')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //references
            $table->foreign('provance_id')
            ->references('id')
            ->on('provinces')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //references
            $table->foreign('city_id')
            ->references('id')
            ->on('cities')
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
        Schema::dropIfExists('admin_addresses');
    }
}
