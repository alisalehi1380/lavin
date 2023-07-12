<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('admin_role', function (Blueprint $table) {
      
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('role_id');
            
            $table->foreign('admin_id')->references('id')->on('admins')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('role_id')->references('id')->on('roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');
       
            $table->primary(['admin_id','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
