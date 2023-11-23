@extends('dashboard.master')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>Edit Task</h1>

                <form action="{{ route('todoLists.tasks.update', [$todoList, $task]) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="todo_list_id" value="{{ $todoList->id }}">
                    <div class="form-group">
                        <label for="name">Task Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $task->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
                    </div>

                    <div class="form-check">
                        <label for="status">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ $task->status ? 'selected' : '' }}>Completed</option>
                            <option value="0" {{ !$task->status ? 'selected' : '' }}>Incomplete</option>
                        </select>
                    </div>
<br>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-warning">Update</button>
                        </div>
                        <div class="cold-md-2">
                            <a href="{{ route('todoLists.show', $todoList) }}" class="btn btn-danger mt-3">Cancel</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
