<div class="min-h-screen bg-neutral-900 text-white py-10">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <img src="{{ $movie->poster_url }}" class="w-72 h-auto rounded shadow"/>
            </div>
            <div class="md:col-span-2">
                <div class="flex items-center justify-between">
                    <div class="text-neutral-300">{{ now()->format('d F Y') }}</div>
                    @if($movie->showtimes->first())
                    <span class="bg-amber-500/70 text-white px-4 py-2 rounded-lg font-semibold">{{ \Carbon\Carbon::parse($movie->showtimes->first()->start_time)->format('H:i') }}-{{ \Carbon\Carbon::parse($movie->showtimes->first()->end_time)->format('H:i') }}</span>
                    @endif
                </div>
                <h1 class="text-2xl font-semibold mt-2">{{ strtoupper($movie->title) }}</h1>
                <div class="text-sm text-neutral-400">{{ $movie->genre }}</div>

                <div class="mt-8">
                    <h3 class="font-semibold mb-2">เรื่องย่อ</h3>
                    <p class="leading-relaxed text-neutral-200">{{ $movie->description }}</p>
                </div>

                @if($movie->showtimes->count())
                    <div class="mt-10">
                        <a href="{{ route('bookings.select', $movie->showtimes->first()) }}" class="inline-block bg-amber-600 hover:bg-amber-500 text-white px-6 py-3 rounded-lg font-semibold">เลือกที่นั่ง</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="mt-16 border-t border-neutral-700 pt-6 text-sm text-neutral-500 text-center">
            <span>SCREEN SEATS DECOR</span>
        </div>
    </div>
</div>
