<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserve_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserve_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('discount_price')->nullable();
            $table->unsignedBigInteger('total_price')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('token')->unique()->nullable();
            $table->string('res_code')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('sale_ref_id')->nullable();
            $table->string('msg')->nullable();
            $table->string('getway')->nullable();
            $table->string('payway')->default('0');
            $table->unsignedTinyInteger('status')->default(0);
            $table->timestamps();

            $table->foreign('reserve_id')
            ->on('service_reserves')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('user_id')
            ->on('users')
            ->references('id')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('discount_id')
            ->on('discounts')
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
        Schema::dropIfExists('reserve_payments');
    }
}
