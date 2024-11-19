<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        return view('task_index', ['tasks' => $tasks]);
    }

    public function create()
    {
        return view('task_create');
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}
