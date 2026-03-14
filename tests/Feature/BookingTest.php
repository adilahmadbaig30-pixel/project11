<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Event;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_cannot_book_beyond_capacity()
    {
        $user = User::factory()->create();
        $organizer = User::factory()->create();

        $event = Event::create([
            'title' => 'Limited Event',
            'description' => 'Only 1 spot',
            'location' => 'Test Location',
            'start_time' => now()->addDays(1),
            'capacity' => 1,
            'available_tickets' => 1,
            'price' => 10,
            'user_id' => $organizer->id
        ]);

        $this->actingAs($user);

        // First booking - should succeed
        $response1 = $this->post(route('bookings.store'), ['event_id' => $event->id]);
        $response1->assertRedirect();
        $this->assertEquals(0, $event->fresh()->available_tickets);

        // Second booking - should fail
        $response2 = $this->post(route('bookings.store'), ['event_id' => $event->id]);
        $response2->assertSessionHas('error', 'Sorry, this event is sold out!');
        $this->assertEquals(0, $event->fresh()->available_tickets);
        $this->assertEquals(1, Booking::count());
    }
}
