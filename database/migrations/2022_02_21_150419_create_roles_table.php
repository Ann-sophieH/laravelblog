<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->timestamps();
        });
        Schema::create('user_role', function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('user_id'); //= samentrekking tabel (enkelvoud) en zijn id
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
            $table->unique(['user_id' , 'role_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                //user_id refereert naar id op tabel users en bij delete van user moet relatie ook deleted worden
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

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
};
