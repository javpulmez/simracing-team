<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RaceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Race::class, 'race');
    }

    public function index()
    {
        $races = Race::withCount('users')
            ->latest()
            ->paginate(10);
            
        return view('races.index', compact('races'));
    }

    public function create()
    {
        return view('races.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'circuit' => 'required|string|max:255',
            'game' => 'required|string|max:255',
            'race_date' => 'required|date|after:now',
            'max_participants' => 'required|integer|min:2|max:50',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $race = Race::create($validated);

        return redirect()->route('races.show', $race)
            ->with('success', 'Carrera creada exitosamente.');
    }

    public function show(Race $race)
    {
        $race->load(['users.driver', 'results.user', 'documents']);
        
        $isRegistered = auth()->check() && $race->users->contains(auth()->id());
        
        return view('races.show', compact('race', 'isRegistered'));
    }

    public function edit(Race $race)
    {
        return view('races.edit', compact('race'));
    }

    public function update(Request $request, Race $race)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'circuit' => 'required|string|max:255',
            'game' => 'required|string|max:255',
            'race_date' => 'required|date',
            'max_participants' => 'required|integer|min:2|max:50',
            'status' => 'required|in:upcoming,ongoing,completed,cancelled',
        ]);

        $race->update($validated);

        return redirect()->route('races.show', $race)
            ->with('success', 'Carrera actualizada exitosamente.');
    }

    public function destroy(Race $race)
    {
        $race->delete();

        return redirect()->route('races.index')
            ->with('success', 'Carrera eliminada exitosamente.');
    }

    public function register(Race $race)
    {
        Gate::authorize('register', $race);
        
        if ($race->users()->count() >= $race->max_participants) {
            return back()->with('error', 'La carrera está llena.');
        }
        
        if ($race->users->contains(auth()->id())) {
            return back()->with('error', 'Ya estás inscrito en esta carrera.');
        }
        
        $race->users()->attach(auth()->id(), [
            'status' => 'registered',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return back()->with('success', 'Te has inscrito exitosamente a la carrera.');
    }

    public function unregister(Race $race)
    {
        Gate::authorize('register', $race);
        
        $race->users()->detach(auth()->id());
        
        return back()->with('success', 'Te has desinscrito de la carrera.');
    }
}