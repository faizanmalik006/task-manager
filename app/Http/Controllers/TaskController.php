<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $projectId = $request->input('project_id');

        // Retrieve all projects to populate the dropdown
        $projects = Project::all();

        // If a project is selected, filter tasks by project
        if ($projectId) {
            $tasks = Task::where('project_id', $projectId)->orderBy('priority')->get();
        } else {
            // If no project is selected, retrieve all tasks
            $tasks = Task::orderBy('priority')->get();
        }

        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function reorder()
    {
    }
}
