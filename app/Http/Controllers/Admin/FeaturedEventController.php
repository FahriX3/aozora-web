<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class FeaturedEventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        $currentFeatured = Event::where('is_aftermovie', true)->first();

        return view('pages.admin.featured-event.index', compact('events', 'currentFeatured'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'youtube_link' => 'required|url',
        ]);

        // Reset all
        Event::query()->update(['is_aftermovie' => false]);

        // Set the new one
        $event = Event::find($request->event_id);
        $event->update([
            'is_aftermovie' => true,
            'youtube_link' => $request->youtube_link,
        ]);

        return redirect()->route('admin.featured-event.index')->with('success', 'Event unggulan untuk aftermovie berhasil diperbarui.');
    }
}
