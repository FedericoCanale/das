<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'type_id'        => 'nullable|exists:types,id',
            'description'    => 'required|string',
            'image'          => 'nullable|string|max:255',
            'github_url'     => 'nullable|url|max:255',
            'live_url'       => 'nullable|url|max:255',
            'technologies'   => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $project = Project::create($data);

        if (isset($data['technologies'])) {
            $project->technologies()->attach($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('success', 'Progetto creato con successo.');
    }

    public function show(Project $project): View
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $request->validate([
            'title'          => 'required|string|max:255',
            'type_id'        => 'nullable|exists:types,id',
            'description'    => 'required|string',
            'image'          => 'nullable|string|max:255',
            'github_url'     => 'nullable|url|max:255',
            'live_url'       => 'nullable|url|max:255',
            'technologies'   => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $project->update($data);
        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', $project)->with('success', 'Progetto aggiornato con successo.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo.');
    }
}
