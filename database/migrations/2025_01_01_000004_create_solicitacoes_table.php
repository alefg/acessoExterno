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
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id();
            $table->string('protocolo')->unique();
            $table->string('nome_completo');
            $table->enum('tipo_representacao', ['pessoa_fisica', 'pessoa_juridica']);
            $table->string('email_pessoal');
            $table->string('email_sei');
            $table->foreignId('orgao_id')->constrained('orgaos')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->enum('status', ['pendente', 'em_analise', 'aprovado', 'concluido'])->default('pendente');
            $table->boolean('termos_aceitos')->default(false);
            $table->text('observacoes')->nullable();
            $table->foreignId('responsavel_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('data_conclusao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};