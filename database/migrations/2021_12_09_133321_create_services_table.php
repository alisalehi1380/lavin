<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sllug');
            $table->unsignedBigInteger('parent');
            $table->unsignedBigInteger('child');
            $table->unsignedTinyInteger('status')->default(1);
            $table->boolean('displayed')->default(0);
            $table->text('desc')->nullable();
            $table->softDeletes();
            $table->timestamps();

            //references
            $table->foreign('parent')
            ->references('id')
            ->on('service_categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //references
            $table->foreign('child')
            ->references('id')
            ->on('service_categories')
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
        Schema::dropIfExists('services');
    }
}
