<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientEventController extends Controller
{
    /**
     * Display event catalog exclusively inside Client Dashboard.
     */
    public function index(Request $request)
    {
        $query = Event::latest('event_date');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('filter') && in_array($request->filter, ['upcoming', 'completed'])) {
            $query->where('status', $request->filter);
        }

        $events = $query->paginate(9)->withQueryString();

        return view('client.events.index', compact('events'));
    }

    /**
     * Show event detail and GATED registration interface.
     */
    public function show($slug)
    {
        $event = Event::where('slug', $slug)->firstOrFail();
        
        $user = Auth::user();
        $isRegistered = $user ? $event->attendees()->where('user_id', $user->id)->exists() : false;

        return view('client.events.show', compact('event', 'isRegistered'));
    }

    /**
     * Handle client registration for an upcoming event.
     */
    public function register(Event $event)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mendaftar event.');
        }

        if ($event->status !== 'upcoming') {
            return redirect()->back()->with('error', 'Pendaftaran untuk event ini sudah ditutup.');
        }

        // Attach registration if not registered
        if (!$event->attendees()->where('user_id', $user->id)->exists()) {
            $event->attendees()->attach($user->id, ['registered_at' => now()]);
        }

        if ($event->registration_link) {
            return redirect()->back()->with('success', 'Berhasil mendaftar di sistem LexaLink! Anda juga dapat mengakses tautan pertemuan/pendaftaran eksternal event.');
        }

        return redirect()->back()->with('success', 'Selamat! Anda berhasil mendaftar untuk event ini. Undangan eksekutif akan dikirim ke Email & WhatsApp Anda.');
    }
}
