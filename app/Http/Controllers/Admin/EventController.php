<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the events.
     */
    public function index(Request $request)
    {
        $query = Event::withCount('attendees')->latest('event_date');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $events = $query->paginate(10)->withQueryString();

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new event.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created event in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required|string|max:50',
            'location_type' => 'required|in:offline,online,hybrid',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'registration_link' => 'nullable|url|max:255',
            'status' => 'required|in:upcoming,completed,cancelled',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Event::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $coverPath = null;
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('events/covers', 'public');
            $coverPath = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $coverPath = $request->cover_image_url;
        }

        Event::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'event_date' => $validated['event_date'],
            'event_time' => $validated['event_time'],
            'location_type' => $validated['location_type'],
            'location' => $validated['location'],
            'description' => $validated['description'],
            'cover_image' => $coverPath,
            'registration_link' => $validated['registration_link'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified event.
     */
    public function edit(Event $event)
    {
        $event->load('attendees');
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified event in storage.
     */
    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'event_time' => 'required|string|max:50',
            'location_type' => 'required|in:offline,online,hybrid',
            'location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'registration_link' => 'nullable|url|max:255',
            'status' => 'required|in:upcoming,completed,cancelled',
        ]);

        if ($event->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $originalSlug = $slug;
            $count = 1;
            while (Event::where('slug', $slug)->where('id', '!=', $event->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            $event->slug = $slug;
        }

        if ($request->hasFile('cover_image')) {
            if ($event->cover_image && str_starts_with($event->cover_image, '/storage/')) {
                $oldPath = str_replace('/storage/', '', $event->cover_image);
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('cover_image')->store('events/covers', 'public');
            $event->cover_image = '/storage/' . $path;
        } elseif ($request->filled('cover_image_url')) {
            $event->cover_image = $request->cover_image_url;
        }

        // Handle gallery images upload if any
        if ($request->hasFile('gallery_files')) {
            $gallery = $event->gallery ?? [];
            foreach ($request->file('gallery_files') as $file) {
                $p = $file->store('events/gallery', 'public');
                $gallery[] = '/storage/' . $p;
            }
            $event->gallery = $gallery;
        } elseif ($request->filled('gallery_urls')) {
            $urls = array_filter(array_map('trim', explode("\n", $request->gallery_urls)));
            $event->gallery = array_values(array_unique(array_merge($event->gallery ?? [], $urls)));
        }

        $event->title = $validated['title'];
        $event->event_date = $validated['event_date'];
        $event->event_time = $validated['event_time'];
        $event->location_type = $validated['location_type'];
        $event->location = $validated['location'];
        $event->description = $validated['description'];
        $event->registration_link = $validated['registration_link'];
        $event->status = $validated['status'];
        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui!');
    }

    /**
     * Remove the specified event from storage.
     */
    public function destroy(Event $event)
    {
        if ($event->cover_image && str_starts_with($event->cover_image, '/storage/')) {
            $oldPath = str_replace('/storage/', '', $event->cover_image);
            Storage::disk('public')->delete($oldPath);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
