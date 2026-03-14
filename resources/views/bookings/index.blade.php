<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b border-gray-200">
                    <h3 class="text-xl font-bold mb-6">Upcoming Events You're Attending</h3>

                    @foreach($bookings as $booking)
                        <div class="flex items-center justify-between p-6 mb-4 bg-gray-50 rounded-2xl border border-gray-100 hover:bg-gray-100 transition duration-150">
                            <div class="flex items-center gap-6">
                                <div class="bg-blue-600 text-white p-4 rounded-xl shadow-lg">
                                    <span class="block text-xs uppercase font-bold text-center opacity-80">{{ \Carbon\Carbon::parse($booking->event->start_time)->format('M') }}</span>
                                    <span class="block text-2xl font-extrabold text-center leading-none">{{ \Carbon\Carbon::parse($booking->event->start_time)->format('d') }}</span>
                                </div>
                                <div>
                                    <h4 class="text-lg font-bold text-gray-900">{{ $booking->event->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $booking->event->location }}</p>
                                    <p class="text-xs text-blue-600 mt-1 font-bold">Ticket: {{ $booking->ticket_code }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('bookings.show', $booking) }}" class="inline-flex items-center text-sm font-bold text-gray-900 hover:text-blue-600 transition duration-150">
                                    View Ticket
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach

                    @if($bookings->isEmpty())
                        <div class="text-center py-12">
                            <p class="text-gray-500 italic mb-4">You haven't booked any tickets yet.</p>
                            <a href="{{ route('dashboard') }}" class="text-blue-600 font-bold hover:underline">Browse Events</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
