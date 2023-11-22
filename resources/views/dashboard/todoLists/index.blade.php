@extends('dashboard.master')

@section('body')

<div class="container">
    <div class="row">
        <div class="col-md-7">
            <h1>To-Do List</h1>
            @if ($todoLists->count() > 0)
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @php $i=1; @endphp
                @foreach($todoLists as $todo)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$todo->name}}</td>
                    <td>{{$todo->created_at->format('Y-m-d H:i:s')}}</td>

                    <td>
                        <div class="row">
                            <div class="col-md-3">
                                <a href="{{ route('todoLists.edit', $todo) }}" class="btn btn-warning">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <a href="{{ route('todoLists.show', $todo) }}" class="btn btn-success">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <form action="{{ route('todoLists.destroy', $todo) }}" method="POST" class="d-inline">
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
                <p class="alert alert-warning">No to-do list available.</p>
            @endif
        </div>
    </div>
</div>
@endsection
