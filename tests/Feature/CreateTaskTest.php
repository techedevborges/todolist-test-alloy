<?php

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task()
    {
        $response = $this->postJson('/api/tarefas', [
            'titulo' => 'Nova tarefa'
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tarefas', ['titulo' => 'Nova tarefa']);
    }
}
