<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('autor_id');
            $table->string('title');
            $table->string('slug'); 
            $table->longText('content');
            $table->dateTime('publishDateTime');
            $table->string('tags')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            //references
            $table->foreign('autor_id')
            ->references('id')
            ->on('admins')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });

        Schema::create('article_article_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('article_categories_id');
            
            $table->foreign('article_id')->references('id')->on('articles')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('article_categories_id')->references('id')->on('article_categories')
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
        Schema::dropIfExists('articles');
    }
}
