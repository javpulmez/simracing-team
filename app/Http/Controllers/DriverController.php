<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class DriverController extends Controller
{
    public function create()
    {
        Gate::authorize('create', Driver::class);
        
        // Solo usuarios pilot sin perfil de driver
        $users = User::where('role', 'pilot')
            ->whereDoesntHave('driver')
            ->get();
            
        return view('drivers.create', compact('users'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Driver::class);
        
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:drivers,user_id',
            'nickname' => 'required|string|max:255|unique:drivers,nickname',
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'racing_number' => 'nullable|string|max:3',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('drivers', 'public');
        }

        $driver = Driver::create($validated);

        return redirect()->route('drivers.public')
            ->with('success', 'Perfil de piloto creado exitosamente.');
    }

    public function edit(Driver $driver)
    {
        Gate::authorize('update', $driver);
        
        return view('drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        Gate::authorize('update', $driver);
        
        $validated = $request->validate([
            'nickname' => 'required|string|max:255|unique:drivers,nickname,' . $driver->id,
            'country' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'racing_number' => 'nullable|string|max:3',
        ]);

        if ($request->hasFile('photo')) {
            if ($driver->photo) {
                Storage::disk('public')->delete($driver->photo);
            }
            $validated['photo'] = $request->file('photo')->store('drivers', 'public');
        }

        $driver->update($validated);

        return redirect()->route('drivers.public')
            ->with('success', 'Perfil de piloto actualizado exitosamente.');
    }

    public function destroy(Driver $driver)
    {
        Gate::authorize('delete', $driver);
        
        if ($driver->photo) {
            Storage::disk('public')->delete($driver->photo);
        }
        
        $driver->delete();

        return redirect()->route('drivers.public')
            ->with('success', 'Perfil de piloto eliminado exitosamente.');
    }
}