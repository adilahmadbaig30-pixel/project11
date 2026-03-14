<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Available Events') }}
            </h2>
            <a href="{{ route('events.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150">
                + Create Event
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($events as $event)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 hover:shadow-md transition duration-200">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-bold mb-2">{{ $event->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $event->description }}</p>
                            
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $event->location }}
                            </div>
                            
                            <div class="flex items-center text-sm text-gray-500 mb-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                {{ \Carbon\Carbon::parse($event->start_time)->format('M d, Y @ h:i A') }}
                            </div>

                            <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-100">
                                <span class="text-lg font-bold text-blue-600">${{ number_format($event->price, 2) }}</span>
                                <span class="text-xs {{ $event->available_tickets > 0 ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }} px-2 py-1 rounded-full px-2 py-1 rounded-full uppercase font-semibold">
                                    {{ $event->available_tickets }} Slots Left
                                </span>
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('events.show', $event) }}" class="block text-center bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            @if($events->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500 italic">No events found. Start by creating one!</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
