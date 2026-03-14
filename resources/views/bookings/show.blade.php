<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Digital Ticket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100">
                <div class="p-0">
                    <!-- Ticket Header -->
                    <div class="bg-blue-600 p-8 text-white text-center">
                        <h3 class="text-2xl font-extrabold mb-1">E-Ticket</h3>
                        <p class="text-xs uppercase tracking-widest opacity-80">Antigravity Events Platform</p>
                    </div>

                    <!-- Ticket Body -->
                    <div class="p-8">
                        <div class="text-center mb-8">
                            <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $booking->event->title }}</h4>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($booking->event->start_time)->format('l, F d, Y @ h:i A') }}</p>
                            <p class="text-sm font-medium text-gray-700 mt-1">{{ $booking->event->location }}</p>
                        </div>

                        <!-- QR Code Section -->
                        <div class="flex justify-center mb-8 p-6 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100">
                                {!! QrCode::size(180)->generate(route('bookings.show', $booking)) !!}
                            </div>
                        </div>

                        <!-- Ticket Footer Info -->
                        <div class="grid grid-cols-2 gap-4 text-center border-t border-gray-100 pt-6">
                            <div>
                                <span class="block text-[10px] uppercase font-bold text-gray-400">Attendee</span>
                                <span class="text-sm font-bold text-gray-900">{{ $booking->user->name }}</span>
                            </div>
                            <div>
                                <span class="block text-[10px] uppercase font-bold text-gray-400">Ticket ID</span>
                                <span class="text-sm font-bold text-blue-600">{{ $booking->ticket_code }}</span>
                            </div>
                        </div>

                        <div class="mt-8 text-center">
                            <p class="text-[10px] text-gray-400">Scan this QR code at the entrance for verification.</p>
                        </div>
                    </div>

                    <!-- Perforation Effect -->
                    <div class="relative h-4 flex items-center justify-between px-[-8px]">
                        <div class="w-8 h-8 rounded-full bg-gray-100 -ml-4 border border-gray-100"></div>
                        <div class="flex-1 border-t-2 border-dashed border-gray-200 mx-1"></div>
                        <div class="w-8 h-8 rounded-full bg-gray-100 -mr-4 border border-gray-100"></div>
                    </div>

                    <div class="p-6 bg-gray-50 text-center">
                        <button onclick="window.print()" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition duration-150">
                            Print Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
