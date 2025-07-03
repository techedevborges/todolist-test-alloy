<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tarefas', function (Blueprint $table) {
            $table->id(); // Identificador único
            $table->string('nome'); // Nome da tarefa (obrigatório)
            $table->text('descricao')->nullable(); // Descrição detalhada (opcional)
            $table->boolean('finalizado')->default(false); // Status de conclusão
            $table->dateTime('data_limite')->nullable(); // Data limite (opcional)
            $table->timestamps(); // created_at e updated_at
            $table->softDeletes(); // deleted_at (soft delete)
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarefas');
    }
};
