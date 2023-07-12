<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReserveUpgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_upgrades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserve_id');
            $table->unsignedBigInteger('service_id');
            $table->string('service_name');
            $table->unsignedBigInteger('detail_id');
            $table->string('detail_name');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('asistant1_id');
            $table->unsignedBigInteger('asistant2_id')->nullable();
            $table->text('desc')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
            
            $table->foreign('reserve_id')->references('id')->on('service_reserves')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('service_id')->references('id')->on('services')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('detail_id')->references('id')->on('service_details')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserve_upgrades');
    }
}
