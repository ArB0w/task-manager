<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
    <title>Task Manager</title>
</head>

<body>
    <h1>Moje úkoly</h1>


    <form action="{{ route('tasks.index') }}" method="GET" class="filters">

        <label for="search">Hledat:</label>

        <input
            type="search"
            name="search"
            id="search"
            value="{{ $search }}"
            placeholder="Název nebo popis úkolu">

        <label for="status">Filtrovat podle stavu:</label>

        <select name="status" id="status">
            <option value="all" {{ $status === 'all' ? 'selected' : '' }}>
                Všechny úkoly
            </option>

            <option value="active" {{ $status === 'active' ? 'selected' : '' }}>
                Nedokončené
            </option>

            <option value="completed" {{ $status === 'completed' ? 'selected' : '' }}>
                Dokončené
            </option>
        </select>

        <button type="submit">Filtrovat</button>
    </form>



    <p>
        <a href="{{ route('tasks.create') }}">+ Přidat úkol</a>
    </p>

    @if (session('success'))
    <p>{{ session('success') }}</p>
    @endif


    @forelse ($tasks as $task)

    <article class="{{ $task->due_date && $task->due_date->lt(today()) && ! $task->completed ? 'task-overdue' : '' }}">
        <h2>{{ $task->title }}</h2>

        @if ($task->description)
        <p>{{ $task->description }}</p>
        @endif

        <p>
            Stav:
            {{ $task->completed ? 'Dokončeno' : 'Nedokončeno' }}
        </p>


        @if ($task->due_date)
        <p>
            Termín: {{ $task->due_date->format('d. m. Y') }}

            @if ($task->due_date->lt(today()) && ! $task->completed)
            <span class="overdue-label">Po termínu</span>
            @endif
        </p>
        @else
        <p>Termín není stanoven.</p>
        @endif

        <a href="{{ route('tasks.edit', $task) }}">Upravit</a>

        <br>
        <form action="{{ route('tasks.toggle', $task) }}" method="POST">
            @csrf
            @method('PATCH')

            <button type="submit">
                {{ $task->completed ? 'Označit jako nedokončený' : 'Označit jako dokončený' }}
            </button>
        </form>

        <form
            action="{{ route('tasks.destroy', $task) }}"
            method="POST"
            onsubmit="return confirm('Opravdu chceš tento úkol smazat?');">
            @csrf
            @method('DELETE')

            <button type="submit">Smazat</button>
        </form>

    </article>
    @empty
    <p>Zatím nemáš žádné úkoly.</p>
    @endforelse
</body>

</html>