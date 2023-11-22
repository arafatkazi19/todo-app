@extends('dashboard.master')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1>Edit To-Do List</h1>

                <form action="{{ route('todoLists.update', $todoList) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">To-Do List Name:</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $todoList->name }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update To-Do List</button>
                </form>
            </div>
        </div>
    </div>
@endsection
