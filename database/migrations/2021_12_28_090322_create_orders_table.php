<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('price')->nullable();
            $table->unsignedBigInteger('discount_price')->nullable();
            $table->unsignedBigInteger('delivery_cost')->nullable();
            $table->unsignedBigInteger('total_price')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->string('token')->unique()->nullable();
            $table->string('full_name');
            $table->text('address')->nullable();
            $table->string('mobile');
            $table->unsignedTinyInteger('delivery')->default(0);
            $table->integer('res_code')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('sale_ref_id')->nullable();
            $table->string('msg')->nullable();
            $table->string('getway')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();


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
        Schema::dropIfExists('orders');
    }
}
