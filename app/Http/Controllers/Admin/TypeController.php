<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeController extends Controller
{
    public function index(): View
    {
        $types = Type::withCount('projects')->get();

        return view('admin.types.index', compact('types'));
    }

    public function create(): View
    {
        return view('admin.types.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:types',
        ]);

        Type::create($data);

        return redirect()->route('admin.types.index')->with('success', 'Tipologia creata con successo.');
    }

    public function edit(Type $type): View
    {
        return view('admin.types.edit', compact('type'));
    }

    public function update(Request $request, Type $type): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:types,name,' . $type->id,
        ]);

        $type->update($data);

        return redirect()->route('admin.types.index')->with('success', 'Tipologia aggiornata con successo.');
    }

    public function destroy(Type $type): RedirectResponse
    {
        $type->delete();

        return redirect()->route('admin.types.index')->with('success', 'Tipologia eliminata con successo.');
    }
}
