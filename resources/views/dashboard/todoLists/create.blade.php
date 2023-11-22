@extends('dashboard.master')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1>Create New To-Do List</h1>

                <form action="{{ route('todoLists.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="name">To-Do List Name:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create To-Do List</button>
                </form>
            </div>
        </div>
    </div>

    @endsection
