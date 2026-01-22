<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $places = Auth::user()->places()->latest()->paginate(12);
        return view('place.index', compact('places'));
    }

    public function create()
    {
        return view('place.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['repair'] = $request->has('repair');
        $validated['work'] = $request->has('work');

        Auth::user()->places()->create($validated); 

        return redirect()->route('place.index')
            ->with('success', 'Место хранения создано');
    }

    public function show(Place $place)
    {
        $this->authorizePlace($place);
        return view('place.show', compact('place'));
    }

    public function edit(Place $place)
    {
        $this->authorizePlace($place);
        return view('place.edit', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        $this->authorizePlace($place);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['repair'] = $request->has('repair');
        $validated['work'] = $request->has('work');

        $place->update($validated);

        return redirect()->route('place.index')
            ->with('success', 'Место обновлено');
    }

    public function destroy(Place $place)
    {
        $this->authorizePlace($place);
        $place->delete();

        return redirect()->route('place.index')
            ->with('success', 'Место удалено');
    }

    private function authorizePlace(Place $place): void
    {
        if ($place->user_id !== Auth::id()) {
            abort(403, 'Это не ваше место');
        }
    }
}