<?php

namespace App\Http\Controllers;
 
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Gate;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('event')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
        ]);

        $event = Event::findOrFail($request->event_id);

        return DB::transaction(function () use ($event) {
            // Lock the record for update to prevent race conditions
            $event = Event::where('id', $event->id)->lockForUpdate()->first();

            if ($event->available_tickets <= 0) {
                return back()->with('error', 'Sorry, this event is sold out!');
            }

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'ticket_code' => 'TKT-' . strtoupper(Str::random(8)),
                'status' => 'confirmed',
            ]);

            $event->decrement('available_tickets');

            return redirect()->route('bookings.show', $booking)->with('success', 'Ticket booked successfully!');
        });
    }

    public function show(Booking $booking)
    {
        Gate::authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }
}
