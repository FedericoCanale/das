<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    public function show(Project $project): View
    {
        return view('admin.projects.show', compact('project'));
    }
}
