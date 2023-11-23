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
        // Ensure the requested to-do list belongs to the authenticated user
        $this->authorizeUser($todoList);

        return view('dashboard.tasks.create', compact('todoList'));
    }

    public function store(Request $request, TodoList $todoList)
    {
        // Ensure the requested to-do list belongs to the authenticated user
        $this->authorizeUser($todoList);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        // Create a new task associated with the to-do list
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
        // Ensure the requested task belongs to the authenticated user
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

            // Update the task attributes
            $validatedData['todo_list_id'] = $todoList->id;

            // Update the task attributes
            $task->update($validatedData);
        }
        return redirect()->route('todoLists.show', $todoList);
    }

    public function destroy(TodoList $todoList, Task $task)
    {
        // Ensure the requested task belongs to the authenticated user
        $this->authorizeUser($task);

        // Delete the task
        $task->delete();

        return redirect()->route('todoLists.show', $todoList);
    }
}
