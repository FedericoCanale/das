<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TechnologyController extends Controller
{
    public function index(): View
    {
        $technologies = Technology::withCount('projects')->get();

        return view('admin.technologies.index', compact('technologies'));
    }

    public function create(): View
    {
        return view('admin.technologies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:technologies',
        ]);

        Technology::create($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia creata con successo.');
    }

    public function edit(Technology $technology): View
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    public function update(Request $request, Technology $technology): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:technologies,name,' . $technology->id,
        ]);

        $technology->update($data);

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia aggiornata con successo.');
    }

    public function destroy(Technology $technology): RedirectResponse
    {
        $technology->delete();

        return redirect()->route('admin.technologies.index')->with('success', 'Tecnologia eliminata con successo.');
    }
}
