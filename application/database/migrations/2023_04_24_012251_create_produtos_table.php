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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 20)->unique(); // add unique constraint to the "codigo" column
            $table->string('nome', 50);
            $table->string('marca', 50);
            $table->text('descricao')->nullable();
            $table->decimal('preco', 10, 2);
            $table->integer('qtd_disponivel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
