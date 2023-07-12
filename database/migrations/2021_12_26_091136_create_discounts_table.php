<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedTinyInteger('unit')->default(0);
            $table->unsignedBigInteger('value');
            $table->dateTime('expire')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('discount_user', function (Blueprint $table) {
 
            $table->unsignedBigInteger('discount_id');
            $table->unsignedBigInteger('user_id');
            
            //references
            $table->foreign('discount_id')
            ->references('id')
            ->on('discounts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //references
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::create('discount_service_detail', function (Blueprint $table) {
 
            $table->unsignedBigInteger('discount_id');
            $table->unsignedBigInteger('service_detail_id');
        
            //references
            $table->foreign('discount_id')
            ->references('id')
            ->on('discounts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //references
            $table->foreign('service_detail_id')
            ->references('id')
            ->on('service_details')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        
        });

        Schema::create('discount_product', function (Blueprint $table) {
 
            $table->unsignedBigInteger('discount_id');
            $table->unsignedBigInteger('product_id');
        
            //references
            $table->foreign('discount_id')
            ->references('id')
            ->on('discounts')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //references
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
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
        Schema::dropIfExists('discounts');
    }
}
