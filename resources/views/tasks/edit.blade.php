<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
    <title>Upravit úkol | Task Manager</title>
</head>

<body>
    <h1>Upravit úkol</h1>

    <form action="{{ route('tasks.update', $task) }}" method="POST" class="task-form">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Název úkolu</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title', $task->title) }}"
                required
                maxlength="255">

            @error('title')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Popis</label>
            <textarea id="description" name="description">{{ old('description', $task->description) }}</textarea>

            @error('description')
            <p>{{ $message }}</p>
            @enderror
        </div>


        <div>
            <label for="due_date">Termín dokončení:</label>

            <input
                type="date"
                name="due_date"
                id="due_date"
                value="{{ old('due_date', $task->due_date?->format('Y-m-d')) }}">

            @error('due_date')
            <p>{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Uložit změny</button>
    </form>

    <p>
        <a href="{{ route('tasks.index') }}">Zpět na seznam</a>
    </p>
</body>

</html>