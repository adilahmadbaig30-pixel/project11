<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-8">
                    <div class="flex flex-wrap md:flex-nowrap gap-12">
                        <div class="w-full md:w-2/3">
                            <h1 class="text-3xl font-extrabold text-gray-900 mb-6">{{ $event->title }}</h1>
                            <div class="prose max-w-none text-gray-700 mb-8">
                                {{ $event->description }}
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
                                <div>
                                    <span class="block text-xs font-semibold text-gray-400 uppercase mb-1">When</span>
                                    <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($event->start_time)->format('F d, Y @ h:i A') }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-gray-400 uppercase mb-1">Where</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $event->location }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-gray-400 uppercase mb-1">Price</span>
                                    <span class="text-sm font-bold text-blue-600">${{ number_format($event->price, 2) }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-gray-400 uppercase mb-1">Availability</span>
                                    <span class="text-sm font-medium {{ $event->available_tickets > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $event->available_tickets }} of {{ $event->capacity }} tickets left
                                    </span>
                                </div>
                            </div>

                            <!-- Countdown Timer -->
                            <div class="mt-8 p-6 bg-premium rounded-2xl text-white shadow-xl">
                                <h4 class="text-xs uppercase tracking-widest font-bold mb-4 opacity-70">Event Starts In</h4>
                                <div class="flex gap-4 text-center" id="countdown" data-start="{{ $event->start_time }}">
                                    <div>
                                        <span class="block text-2xl font-black" id="days">00</span>
                                        <span class="text-[10px] uppercase font-bold opacity-60 font-medium">Days</span>
                                    </div>
                                    <div class="text-2xl font-black opacity-30">:</div>
                                    <div>
                                        <span class="block text-2xl font-black" id="hours">00</span>
                                        <span class="text-[10px] uppercase font-bold opacity-60 font-medium">Hours</span>
                                    </div>
                                    <div class="text-2xl font-black opacity-30">:</div>
                                    <div>
                                        <span class="block text-2xl font-black" id="minutes">00</span>
                                        <span class="text-[10px] uppercase font-bold opacity-60 font-medium">Mins</span>
                                    </div>
                                    <div class="text-2xl font-black opacity-30">:</div>
                                    <div>
                                        <span class="block text-2xl font-black" id="seconds">00</span>
                                        <span class="text-[10px] uppercase font-bold opacity-60 font-medium">Secs</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            function updateCountdown() {
                                const targetDate = new Date(document.getElementById('countdown').dataset.start).getTime();
                                const now = new Date().getTime();
                                const distance = targetDate - now;

                                if (distance < 0) {
                                    document.getElementById('countdown').innerHTML = "<span class='text-lg font-bold'>Event has started!</span>";
                                    return;
                                }

                                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                document.getElementById('days').innerText = days.toString().padStart(2, '0');
                                document.getElementById('hours').innerText = hours.toString().padStart(2, '0');
                                document.getElementById('minutes').innerText = minutes.toString().padStart(2, '0');
                                document.getElementById('seconds').innerText = seconds.toString().padStart(2, '0');
                            }
                            setInterval(updateCountdown, 1000);
                            updateCountdown();
                        </script>

                        <div class="w-full md:w-1/3">
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm sticky top-8">
                                <h3 class="text-lg font-bold text-gray-900 mb-4">Secure Your Spot</h3>
                                
                                <p class="text-sm text-gray-500 mb-6">Join us for this amazing event. Your ticket includes full access and digital verification.</p>

                                <form action="{{ route('bookings.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    
                                    @if($event->available_tickets > 0)
                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition duration-200 transform hover:-translate-y-0.5">
                                            Book Ticket Now
                                        </button>
                                    @else
                                        <button disabled class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-4 rounded-xl cursor-not-allowed">
                                            Sold Out
                                        </button>
                                    @endif
                                </form>

                                <p class="mt-4 text-[10px] text-gray-400 text-center">
                                    Powered by Antigravity Events Platform
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
