<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventDocumentation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view('pages.admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('pages.admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,completed',
            'poster' => 'nullable|image|max:512000', // max 500MB
            'is_featured' => 'nullable|boolean',
            'rundowns' => 'nullable|array',
            'rundowns.*.time' => 'required',
            'rundowns.*.title' => 'required|string',
            'rundowns.*.description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'visitor_access_instructions' => 'nullable|string',
            'location_assistance' => 'nullable|string',
        ]);

        $validated['is_featured'] = $request->has('is_featured');
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        
        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('events', 'public');
        }

        $event = Event::create($validated);
        
        if ($request->has('rundowns') && is_array($request->rundowns)) {
            foreach ($request->rundowns as $rundown) {
                $event->rundowns()->create($rundown);
            }
        }
        
        return redirect()->route('admin.events.edit', $event)->with('success', 'Event created successfully. You can now add documentations.');
    }

    public function edit(Event $event)
    {
        return view('pages.admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'location' => 'nullable|string|max:255',
            'status' => 'required|in:upcoming,completed',
            'poster' => 'nullable|image|max:512000',
            'is_featured' => 'nullable|boolean',
            'rundowns' => 'nullable|array',
            'rundowns.*.time' => 'required',
            'rundowns.*.title' => 'required|string',
            'rundowns.*.description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'visitor_access_instructions' => 'nullable|string',
            'location_assistance' => 'nullable|string',
        ]);

        $validated['is_featured'] = $request->has('is_featured');

        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('events', 'public');
        }

        $event->update($validated);

        // Handle Rundowns
        $event->rundowns()->delete();
        if ($request->has('rundowns') && is_array($request->rundowns)) {
            foreach ($request->rundowns as $rundown) {
                $event->rundowns()->create($rundown);
            }
        }

        return redirect()->route('admin.events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully.');
    }

    public function uploadDocumentation(Request $request, Event $event)
    {
        $request->validate([
            'file' => 'required|file|max:512000', // max 500MB
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('events/documentations', 'public');
            
            $mimeType = $request->file('file')->getMimeType();
            $fileType = str_contains($mimeType, 'video') ? 'video' : 'image';

            $doc = $event->documentations()->create([
                'file_path' => $path,
                'file_type' => $fileType,
            ]);

            return response()->json(['success' => true, 'id' => $doc->id]);
        }
        
        return response()->json(['success' => false], 400);
    }
}
