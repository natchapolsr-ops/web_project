<div class="min-h-screen bg-neutral-900 text-black py-10">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-semibold mb-6">Your Booking</h1>

        <div class="bg-neutral-700/70 rounded-xl p-4 flex items-center gap-4">
            <img src="{{ $booking->showtime->movie->poster_url }}" class="w-24 h-28 object-cover rounded"/>
            <div class="flex-1 grid grid-cols-3 gap-4 items-center">
                <div>
                    <div class="text-lg font-semibold">{{ $booking->showtime->movie->title }}</div>
                    <div class="text-sm text-neutral-300">Show time</div>
                    <div class="text-sm">{{ \Carbon\Carbon::parse($booking->showtime->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($booking->showtime->end_time)->format('H:i') }}</div>
                </div>
                <div>
                    <div class="text-sm text-neutral-300">Status</div>
                    <div class="text-green-400 font-semibold">{{ ucfirst($booking->status) }}</div>
                </div>
                <div>
                    <div class="text-sm text-neutral-300">Balance</div>
                    <div class="font-semibold">{{ $booking->total_amount }}฿</div>
                </div>
            </div>
        </div>
    </div>
</div>
