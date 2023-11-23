@extends('dashboard.master')

@section('body')

    <div class="container">
        <div class="row">
            <div class="col-md-7">

                <div class="row">
                    <div class="col-md-8">
                        <h1>{{ $todoList->name }}</h1>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('todoLists.tasks.create', $todoList) }}" class="btn btn-success" style="margin-top:12px">Add Task</a>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('todoLists.index') }}" class="btn btn-warning" style="margin-top:12px">Back</a>
                    </div>
                </div>
<hr>

                <p>List of Tasks:</p>

                @if ($todoList->tasks->count() > 0)
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        @php $i=1; @endphp
                        @foreach($todoList->tasks as $task)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->description }}</td>
                                <td>
                                    @if ($task->status == 1)
                                        <span class="badge badge-pill badge-success">Completed</span>
                                    @else
                                        <span class="badge badge-pill badge-danger">Incomplete</span>
                                    @endif
                                </td>

                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('todoLists.tasks.edit', [$todoList, $task]) }}" class="btn btn-warning">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <form action="{{ route('todoLists.tasks.destroy', [$todoList, $task]) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                                    <span class="glyphicon glyphicon-trash"></span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No tasks in this to-do list.</p>
                @endif

{{--                <a href="{{ route('todoLists.edit', $todoList) }}" class="btn btn-warning">Edit</a>--}}
{{--                <form action="{{ route('todoLists.destroy', $todoList) }}" method="POST" class="d-inline">--}}
{{--                    @csrf--}}
{{--                    @method('DELETE')--}}
{{--                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>--}}
{{--                </form>--}}
            </div>
        </div>
    </div>
@endsection
