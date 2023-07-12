<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceReservesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reserves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('service_id');
            $table->string('service_name');
            $table->unsignedBigInteger('detail_id');
            $table->string('detail_name');
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('secratry_id')->nullable();
            $table->unsignedBigInteger('asistant_id')->nullable();
            $table->DateTime('time')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('service_id')->references('id')->on('services')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('detail_id')->references('id')->on('service_details')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('doctor_id')->references('id')->on('admins')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('secratry_id')->references('id')->on('admins')
            ->onDelete('cascade')->onUpdate('cascade');
          
            $table->foreign('asistant_id')->references('id')->on('admins')
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
        Schema::dropIfExists('service_reserves');
    }
}
