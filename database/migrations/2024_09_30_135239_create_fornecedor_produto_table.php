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
        Schema::create('fornecedor_produto', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produto');
            $table->unsignedBigInteger('id_fornecedor');
            $table->timestamps();
            
            $table->foreign('id_produto')->references('id')->on('produtos')->onDelete('cascade');
            $table->foreign('id_fornecedor')->references('id')->on('fornecedores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fornecedor_produto');
    }
};
