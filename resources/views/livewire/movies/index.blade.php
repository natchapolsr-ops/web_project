<div class="min-h-screen bg-neutral-900 text-white py-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-semibold mb-6">Now Showing</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($movies as $movie)
            <a href="{{ route('movies.show',$movie) }}" class="bg-neutral-800 rounded-lg overflow-hidden hover:ring-2 ring-amber-500 transition">
                <img src="{{ $movie->poster_url }}" alt="{{ $movie->title }}" class="w-full h-56 object-cover">
                <div class="p-3">
                    <div class="font-semibold">{{ $movie->title }}</div>
                    <div class="text-xs text-neutral-400">{{ strtoupper($movie->genre) }}</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>
