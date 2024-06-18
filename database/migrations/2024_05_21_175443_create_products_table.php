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

        Schema::create('categories', function (Blueprint $table){
            $table->id();
            $table->string('nome');
            $table->timestamps();
        });
        

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('valor');
            $table->timestamps();
        });

        Schema::create('employees', function (Blueprint $table){
            $table->id();
            $table->string('nome');
            $table->string('setor');
            $table->string('salario');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
