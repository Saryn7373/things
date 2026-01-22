<?php

namespace App\Http\Controllers;

use App\Models\Thing;
use App\Models\User;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $things = Auth::user()->things()->latest()->paginate(10);
        return view('things.index', compact('things'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $places = Auth::user()->places()->orderBy('name')->get();
        return view('things.create', compact('users', 'places'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'wrnt'        => 'nullable|date',
            'owner_id'    => 'nullable|exists:users,id',
            'place_id'    => 'nullable|exists:places,id',
            'amount'      => 'nullable|integer|min:1',
        ]);

        $thing = Auth::user()->things()->create([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'wrnt'        => $validated['wrnt'],
        ]);

        if (!empty($validated['place_id'])) {
            $thing->uses()->create([
                'place_id' => $validated['place_id'],
                'user_id'  => $validated['owner_id'] ?? Auth::id(),
                'amount'   => $validated['amount'] ?? 1,
            ]);
        }

        return redirect()->route('things.index')
            ->with('success', 'Вещь добавлена');
    }

    public function show(Thing $thing)
    {
        $this->authorizeThing($thing);
        $thing->load(['user', 'uses.place', 'uses.user']);
        return view('things.show', compact('thing'));
    }

    public function edit(Thing $thing)
    {
        $this->authorizeThing($thing);
        $users = User::orderBy('name')->get();
        $places = Auth::user()->places()->orderBy('name')->get();
        
        $currentUse = $thing->currentUse();
        
        return view('things.edit', compact('thing', 'users', 'places', 'currentUse'));
    }

    public function update(Request $request, Thing $thing)
    {
        $this->authorizeThing($thing);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'wrnt'        => 'nullable|date',
            'owner_id'    => 'nullable|exists:users,id',
            'place_id'    => 'nullable|exists:places,id',
            'amount'      => 'nullable|integer|min:1',
        ]);

        $thing->update([
            'name'        => $validated['name'],
            'description' => $validated['description'],
            'wrnt'        => $validated['wrnt'],
        ]);

        if (!empty($validated['place_id'])) {
            $currentUse = $thing->currentUse();
            
            if ($currentUse) {
                $currentUse->update([
                    'place_id' => $validated['place_id'],
                    'user_id'  => $validated['owner_id'] ?? Auth::id(),
                    'amount'   => $validated['amount'] ?? 1,
                ]);
            } else {
                $thing->uses()->create([
                    'place_id' => $validated['place_id'],
                    'user_id'  => $validated['owner_id'] ?? Auth::id(),
                    'amount'   => $validated['amount'] ?? 1,
                ]);
            }
        }

        return redirect()->route('things.index')
            ->with('success', 'Вещь обновлена');
    }

    public function destroy(Thing $thing)
    {
        $this->authorizeThing($thing);
        $thing->delete();

        return redirect()->route('things.index')
            ->with('success', 'Вещь удалена');
    }

    private function authorizeThing(Thing $thing): void
    {
        if ($thing->user_id !== Auth::id()) {
            abort(403, 'Это не ваша вещь');
        }
    }
}