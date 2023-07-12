<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->string('code')->nullable();
            $table->DateTime('codeStartDate')->nullable();
            $table->DateTime('expireDate')->nullable();   
            $table->string('speciality')->nullable();
            $table->text('desc')->nullable();
            $table->text('video')->nullable();
            $table->timestamps();

            $table->foreign('admin_id')
            ->on('admins')
            ->references('id')
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
        Schema::dropIfExists('doctors');
    }
}
