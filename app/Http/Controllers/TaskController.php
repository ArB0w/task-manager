<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{



    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search', '');

        $query = Task::query();

        if ($status === 'active') {
            $query->where('completed', false);
        } elseif ($status === 'completed') {
            $query->where('completed', true);
        }

        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $tasks = $query->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'status' => $status,
            'search' => $search,
        ]);
    }




    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],

        ]);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Úkol byl vytvořen.');
    }


    public function edit(Task $task): View
    {
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],

        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Úkol byl upraven.');
    }


    public function toggle(Task $task): RedirectResponse
    {
        $task->update([
            'completed' => ! $task->completed,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Stav úkolu byl změněn.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Úkol byl smazán.');
    }
}
