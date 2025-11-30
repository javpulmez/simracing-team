<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\RaceResult;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->isAdmin()) {
            $totalRaces = Race::count();
            $upcomingRaces = Race::where('status', 'upcoming')->count();
            $completedRaces = Race::where('status', 'completed')->count();
            
            return view('dashboard.admin', compact('totalRaces', 'upcomingRaces', 'completedRaces'));
        }
        
        if ($user->isPilot()) {
            $myRaces = $user->races()->with('users')->get();
            $myResults = RaceResult::where('user_id', $user->id)
                ->with('race')
                ->latest()
                ->take(5)
                ->get();
                
            return view('dashboard.pilot', compact('myRaces', 'myResults'));
        }
        
        return view('dashboard.visitor');
    }
}