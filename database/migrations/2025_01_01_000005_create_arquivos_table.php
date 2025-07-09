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
        Schema::create('arquivos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solicitacao_id')->constrained('solicitacoes')->onDelete('cascade');
            $table->string('tipo_documento'); // Ex: termo_assinado, documento_cpf, selfie, procuracao
            $table->string('caminho_arquivo');
            $table->string('nome_original');
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('tamanho')->nullable(); // size in bytes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arquivos');
    }
};