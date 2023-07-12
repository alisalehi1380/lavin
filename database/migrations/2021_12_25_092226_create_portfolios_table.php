<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug',255);
            $table->text('descriotion')->nullable();
            $table->unsignedBigInteger('before')->nullable();
            $table->unsignedBigInteger('after')->nullable();
            $table->unsignedBigInteger('poster')->nullable();
            $table->text('video')->nullable();
            $table->unsignedTinyInteger('status')->default(1);
            $table->timestamps();

            //references
            $table->foreign('before')
            ->references('id')
            ->on('images')
            ->onDelete('SET NULL')
            ->onUpdate('SET NULL');

            //references
            $table->foreign('after')
            ->references('id')
            ->on('images')
            ->onDelete('SET NULL')
            ->onUpdate('SET NULL');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profilos');
    }
}
