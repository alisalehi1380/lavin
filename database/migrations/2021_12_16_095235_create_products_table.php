<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug'); 
            $table->unsignedBigInteger('parent');
            $table->unsignedBigInteger('child')->nullable();
            $table->text('description')->nullable();
            $table->text('attributes')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedBigInteger('stock')->default(0);
            $table->boolean('special')->default(0);
            $table->DateTime('specialDateTime')->nullable();
            $table->unsignedBigInteger('specialPrice')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            //references
            $table->foreign('parent')
            ->references('id')
            ->on('product_categories')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            //references
            $table->foreign('child')
            ->references('id')
            ->on('product_categories')
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
        Schema::dropIfExists('products');
    }
}
