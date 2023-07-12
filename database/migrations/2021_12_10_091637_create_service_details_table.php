<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('name');
            $table->string('sllug');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('porsant')->default(0);
            $table->unsignedBigInteger('point')->default(0);
            $table->text('breif')->nullable();
            $table->text('desc')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();

            //references
            $table->foreign('service_id')
            ->references('id')
            ->on('services')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::create('doctor_service', function (Blueprint $table) {
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('service_id');
            
            $table->foreign('doctor_id')->references('id')->on('admins')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('service_id')->references('id')->on('service_details')
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
        Schema::dropIfExists('service_detils');
        Schema::dropIfExists('doctor_service');
    }
}
