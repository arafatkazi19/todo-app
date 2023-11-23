<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $todoListCount = auth()->user()->todoLists()->count();
        $tasksCount = auth()->user()->todoLists()->withCount('tasks')->get()->sum('tasks_count');
        $incompleteTasksCount = auth()->user()->todoLists->flatMap->tasks->where('status', 0)->count();



        return view('dashboard.home.home', compact( 'todoListCount', 'tasksCount', 'incompleteTasksCount'));
    }
}
