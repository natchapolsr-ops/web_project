<div class="min-h-screen bg-neutral-900 text-black py-10">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-semibold mb-6">Now Showing</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($movies as $movie)
            @php
                // ถ้าเป็น URL เต็มหรือขึ้นต้นด้วย / ให้ใช้ตรงๆ ถ้าไม่ใช่ให้ชี้ไปที่ public/images/ ตามชื่อไฟล์
                $poster = Str::startsWith($movie->poster_url, ['http://','https://','/'])
                    ? $movie->poster_url
                    : asset('images/' . ltrim($movie->poster_url ?? '', '/'));
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
