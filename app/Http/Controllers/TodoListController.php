<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function authorizeUser($todoList)
    {
        if ($todoList->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index()
    {
        // Fetch all to-do lists for the authenticated user
        $todoLists = auth()->user()->todoLists;
        //dd($todoLists);

        return view('dashboard.todoLists.index', compact('todoLists'));
    }

    public function create()
    {
        return view('dashboard.todoLists.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create a new to-do list associated with the authenticated user
        $todoList = auth()->user()->todoLists()->create([
            'name' => $validatedData['name'],
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('todoLists.index');
    }

    public function show(TodoList $todoList)
    {
        $this->authorizeUser($todoList);

        return view('dashboard.todoLists.show', compact('todoList'));
    }

    public function edit(TodoList $todoList)
    {
        $this->authorizeUser($todoList);

        return view('dashboard.todoLists.edit', compact('todoList'));
    }

    public function update(Request $request, TodoList $todoList)
    {
        $this->authorizeUser($todoList);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the to-do list attributes
        $todoList->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('todoLists.index');
    }

    public function destroy(TodoList $todoList)
    {
        $this->authorizeUser($todoList);

        // Delete the to-do list
        $todoList->delete();

        return redirect()->route('todoLists.index');
    }
}
