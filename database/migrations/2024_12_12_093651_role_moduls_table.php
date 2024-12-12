<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role_moduls', function (Blueprint $table) {
            //---- MAIN COLOUMNS ----//
            $table->id();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('moduls_id');
            $table->enum('access', ['yes', 'no'])->nullable()->default('no');
            $table->enum('create', ['yes', 'no'])->nullable()->default('no');
            $table->enum('update', ['yes', 'no'])->nullable()->default('no');
            $table->enum('delete', ['yes', 'no'])->nullable()->default('no');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('moduls_id')->references('id')->on('moduls');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_moduls');
    }
};
