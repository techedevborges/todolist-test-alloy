<?php

use App\Http\Controllers\TasksController;
use Illuminate\Support\Facades\Route;

Route::apiResource('tarefas', TasksController::class);

// Rota adicional para alternar status de finalizado
Route::patch('tarefas/{id}/finalizar', [TasksController::class, 'toggleFinalizado']);

Route::post('/tarefas/{id}/finalizar', [TasksController::class, 'finalizar']);
