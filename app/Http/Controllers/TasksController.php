<?php

namespace App\Http\Controllers;

use App\Jobs\DeleteTaskJob;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        return Task::all(); // Eloquent ignora registros deletados com softDeletes por padrão
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'finalizado' => 'boolean',
            'data_limite' => 'nullable|date',
        ]);

        $tarefa = Task::create($validated);
        return response()->json($tarefa, 201);
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tarefa = Task::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'descricao' => 'nullable|string',
            'finalizado' => 'boolean',
            'data_limite' => 'nullable|date',
        ]);

        $tarefa->update($validated);
        return response()->json($tarefa);
    }

    public function toggleFinalizado($id)
    {
        $tarefa = Task::findOrFail($id);
        $tarefa->finalizado = !$tarefa->finalizado;
        $tarefa->save();

        return response()->json($tarefa);
    }

    public function finalizar($id)
    {
        $tarefa = Task::findOrFail($id);
        $tarefa->finalizada = true;
        $tarefa->save();

        // Agenda o job para excluir em 10 minutos
        DeleteTaskJob::dispatch($tarefa->id)->delay(now()->addMinutes(10));

        return response()->json(['mensagem' => 'Tarefa finalizada. Será excluída em 10 minutos.']);
    }

    public function destroy($id)
    {
        $tarefa = Task::findOrFail($id);
        $tarefa->delete();
        return response()->json(null, 204);
    }
}
