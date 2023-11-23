@extends('dashboard.master')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-7 mx-auto">
                <h1>Create New Task</h1>

                <form action="{{ route('todoLists.tasks.store', $todoList) }}" method="POST">
                    @csrf
                        <input type="hidden" name="todo_list_id" value="{{$todoList->id}}">
                    <div class="form-group">
                        <label for="name">Task Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>

                    <div class="form-check">
                        <label for="status">Status:</label>
                        <select class="form-control" id="status" name="status">
                            <option value=""></option>
                            <option value="0">Incomplete</option>
                            <option value="1">Complete</option>
                        </select>
                    </div>
<br>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Create Task</button>
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
