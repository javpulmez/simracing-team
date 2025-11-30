<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\News;
use App\Models\Race;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $upcomingRaces = Race::where('status', 'upcoming')
            ->orderBy('race_date', 'asc')
            ->take(3)
            ->get();
            
        $latestNews = News::where('published', true)
            ->with('user')
            ->latest()
            ->take(3)
            ->get();
            
        $drivers = Driver::with('user')->take(6)->get();
        
        return view('home', compact('upcomingRaces', 'latestNews', 'drivers'));
    }
    
    public function drivers()
    {
        $drivers = Driver::with('user')->paginate(12);
        return view('drivers.public', compact('drivers'));
    }
    
    public function news()
    {
        $news = News::where('published', true)
            ->with('user')
            ->latest()
            ->paginate(9);
            
        return view('news.public', compact('news'));
    }
    
    public function showNews(News $news)
    {
        if (!$news->published && (!auth()->check() || !auth()->user()->isAdmin())) {
            abort(404);
        }
        
        $news->load('user');
        return view('news.show-public', compact('news'));
    }
}