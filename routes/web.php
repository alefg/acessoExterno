<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SolicitacaoController;
use Illuminate\Support\Facades\Route;

// Rota principal pública com as instruções iniciais
Route::get('/', function () {
    return view('welcome');
});

// Rotas para o formulário público de solicitação
Route::get('/solicitacao/criar', [SolicitacaoController::class, 'create'])->name('solicitacao.create');
Route::post('/solicitacao', [SolicitacaoController::class, 'store'])->name('solicitacao.store');

// Rotas para usuários autenticados (Responsáveis de Área e Superadmins)
Route::middleware(['auth'])->group(function () {
    // O Dashboard agora lista as solicitações e requer que o e-mail seja verificado.
    Route::get('/dashboard', [SolicitacaoController::class, 'index'])->middleware('verified')->name('dashboard');

    // Rotas para visualizar e atualizar uma solicitação específica.
    // A rota 'solicitacoes.show' é usada no e-mail de notificação.
    Route::get('/solicitacoes/{solicitacao}', [SolicitacaoController::class, 'show'])->middleware('verified')->name('solicitacoes.show');
    Route::patch('/solicitacoes/{solicitacao}', [SolicitacaoController::class, 'update'])->middleware('verified')->name('solicitacoes.update');

    // Rotas de gerenciamento de perfil do usuário (geradas pelo Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
