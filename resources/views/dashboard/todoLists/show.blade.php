@extends('dashboard.master')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>{{ $todoList->name }}</h1>

                <a href="{{ route('todoLists.index') }}" class="btn btn-secondary">Back to To-Do Lists</a>

                <p>List of Tasks:</p>
                @if ($todoList->tasks->count() > 0)
                    <ul>
                        @foreach ($todoList->tasks as $task)
                            <li>{{ $task->name }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>No tasks in this to-do list.</p>
                @endif

                <a href="{{ route('todoLists.edit', $todoList) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('todoLists.destroy', $todoList) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
