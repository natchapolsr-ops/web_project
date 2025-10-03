<div class="min-h-screen bg-neutral-900 text-black py-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-semibold mb-6">Now Showing</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($movies as $movie)
            @php
                $poster = Str::startsWith($movie->poster_url, ['http://','https://','/'])
                    ? $movie->poster_url
                    : asset($movie->poster_url ?? 'https://occ-0-8407-2219.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABfgDSo3bKLA39qLUxd1bbr9YMMMCrpAfdTuwljzkLKvCmRTXC5yAWrmezCVzc3HTmAsoVaUbyUKCxARsOb_rMEjmx1RacSbQ0M-X.jpg?r=33c');
            @endphp
            <a href="{{ route('movies.show',$movie) }}" class="bg-neutral-800 rounded-lg overflow-hidden hover:ring-2 ring-amber-500 transition flex flex-col items-center">
                <img src="{{ $poster }}" alt="{{ $movie->title }}" class="h-28 max-w-[100px] object-cover mt-4 mb-2 rounded shadow">
                <div class="p-3">
                    <div class="font-semibold">{{ $movie->title }}</div>
                    <div class="text-xs text-neutral-400">{{ strtoupper($movie->genre) }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
