<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $upcomingEvents = Event::where('status', 'upcoming')
                               ->orderBy('event_date', 'asc')
                               ->limit(3)
                               ->get();
                               
        $featuredEvents = Event::where('is_featured', true)
                               ->orderBy('created_at', 'desc')
                               ->limit(3)
                               ->get();
                               
        $aftermovieEvent = Event::with('documentations')->where('is_aftermovie', true)->first();

        return view('pages.home', compact('upcomingEvents', 'featuredEvents', 'aftermovieEvent'));
    }

    public function list(Request $request)
    {
        $query = Event::query();

        if ($request->has('filter')) {
            $filter = $request->filter;
            if (in_array($filter, ['upcoming', 'completed'])) {
                $query->where('status', $filter);
            }
        }

        // Upcoming events first, then by date descending
        $events = $query->orderByRaw("CASE WHEN status = 'upcoming' THEN 1 ELSE 2 END")
                        ->orderBy('event_date', 'desc')
                        ->paginate(9);
                        
        return view('pages.events', compact('events'));
    }

    public function show($slug)
    {
        $event = Event::with('documentations')->where('slug', $slug)->firstOrFail();
        return view('pages.event-detail', compact('event'));
    }
}
