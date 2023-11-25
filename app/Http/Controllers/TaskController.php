<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    //
    private $task;

    public function __construct()
    {
        $this->middleware('auth');

    }

    private function authorizeUser($task)
    {
        if ($task->todoList && $task->todoList->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function create(TodoList $todoList)
    {

        $this->authorizeUser($todoList);

        return view('dashboard.tasks.create', compact('todoList'));
    }

    public function store(Request $request, TodoList $todoList)
    {

        $this->authorizeUser($todoList);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);


        $todoList->tasks()->create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'completed' => false,
            'todo_list_id' => $todoList->id,
        ]);

        return redirect()->route('todoLists.show', $todoList);
    }

    public function edit(TodoList $todoList, Task $task)
    {

        $this->authorizeUser($task);

        return view('dashboard.tasks.edit', compact('todoList', 'task'));
    }

    public function update(Request $request, TodoList $todoList, Task $task)
    {

        if ($task->todoList->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');

        }else{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required',
                'status' => 'required',
            ]);


            $validatedData['todo_list_id'] = $todoList->id;


            $task->update($validatedData);
        }
        return redirect()->route('todoLists.show', $todoList);
    }

    public function destroy(TodoList $todoList, Task $task)
    {

        $this->authorizeUser($task);


        $task->delete();

        return redirect()->route('todoLists.show', $todoList);
    }
}
