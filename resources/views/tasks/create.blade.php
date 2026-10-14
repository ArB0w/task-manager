<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
    <title>Nový úkol | Task Manager</title>
</head>

<body>
    <h1>Nový úkol</h1>

    <form action="{{ route('tasks.store') }}" method="POST" class="task-form">
        @csrf

        <div>
            <label for="title">Název úkolu</label>
            <input
                type="text"
                id="title"
                name="title"
                value="{{ old('title') }}"
                required
                maxlength="255">

            @error('title')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="description">Popis</label>
            <textarea
                id="description"
                name="description">{{ old('description') }}</textarea>

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
                value="{{ old('due_date') }}">

            @error('due_date')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <button type="submit">Uložit úkol</button>
    </form>

    <p>
        <a href="{{ route('tasks.index') }}">Zpět na seznam</a>
    </p>
</body>

</html>