<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskManagerTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_page_is_accessible(): void
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function test_task_can_be_created(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => 'Naučit se Laravel testy',
            'description' => 'Vyzkoušet Feature test',
            'due_date' => '2030-01-15',
        ]);

        $response->assertRedirect(route('tasks.index'));

        $this->assertDatabaseHas('tasks', [
            'title' => 'Naučit se Laravel testy',
            'description' => 'Vyzkoušet Feature test',
            'completed' => false,
        ]);

        $task = Task::where('title', 'Naučit se Laravel testy')->firstOrFail();

        $this->assertSame('2030-01-15', $task->due_date->format('Y-m-d'));
    }

    public function test_task_title_is_required(): void
    {
        $response = $this->post(route('tasks.store'), [
            'title' => '',
            'description' => 'Úkol bez názvu',
        ]);

        $response->assertSessionHasErrors('title');

        $this->assertDatabaseCount('tasks', 0);
    }

    public function test_tasks_can_be_filtered_by_status(): void
    {
        Task::create([
            'title' => 'Nedokončený úkol',
            'completed' => false,
        ]);

        Task::create([
            'title' => 'Dokončený úkol',
            'completed' => true,
        ]);

        $response = $this->get(
            route('tasks.index', ['status' => 'active'])
        );

        $response->assertOk();
        $response->assertSee('Nedokončený úkol');
        $response->assertDontSee('Dokončený úkol');
    }
}
