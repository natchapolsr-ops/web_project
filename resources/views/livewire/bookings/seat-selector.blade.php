<div class="min-h-screen bg-neutral-900 text-white">
    <div class="max-w-7xl mx-auto py-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-neutral-800/60 rounded-xl p-6 relative">
                <div class="text-center mb-6">
                    <div class="inline-block border border-amber-500 px-6 py-2 rounded">SCREEN</div>
                </div>

                <div class="space-y-2">
                    @foreach($seatRows as $rowLabel => $row)
                        <div class="flex items-center gap-2">
                            <div class="w-6 text-xs text-neutral-400">{{ $rowLabel }}</div>
                            <div class="grid grid-cols-18 gap-2 flex-1">
                                @foreach($row as $seat)
                                    @php
                                        $isSelected = $selectedSeats->contains($seat->id);
                                        $color = match($seat->type) {
                                            'vip' => 'bg-yellow-600',
                                            'opera' => 'bg-amber-700',
                                            'honeymoon' => 'bg-purple-700',
                                            'disabled' => 'bg-gray-500',
                                            default => 'bg-red-700'
                                        };
                                    @endphp
                                    <button wire:click="toggleSeat({{ $seat->id }})"
                                            class="h-6 w-6 rounded-sm {{ $color }} {{ $isSelected ? 'ring-2 ring-white' : '' }}"
                                            title="{{ $rowLabel }}{{ $seat->number }}">
                                    </button>
                                @endforeach
                            </div>
                            <div class="w-6 text-xs text-neutral-400">{{ $rowLabel }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 grid grid-cols-4 gap-4">
                    <div class="text-center bg-neutral-700/60 rounded-2xl p-4 border border-amber-600">
                        <div class="mx-auto h-6 w-6 rounded-sm bg-red-700"></div>
                        <div class="mt-2 text-sm">Normal</div>
                        <div class="text-xs text-neutral-300">{{ $showtime->base_price }} THB</div>
                    </div>
                    <div class="text-center bg-neutral-700/60 rounded-2xl p-4 border border-amber-600">
                        <div class="mx-auto h-6 w-6 rounded-sm bg-purple-700"></div>
                        <div class="mt-2 text-sm">Honeymoon</div>
                        <div class="text-xs text-neutral-300">{{ $showtime->base_price + 20 }} THB</div>
                    </div>
                    <div class="text-center bg-neutral-700/60 rounded-2xl p-4 border border-amber-600">
                        <div class="mx-auto h-6 w-6 rounded-sm bg-amber-700"></div>
                        <div class="mt-2 text-sm">Opera Chair</div>
                        <div class="text-xs text-neutral-300">{{ $showtime->base_price + 300 }} THB</div>
                    </div>
                    <div class="text-center bg-neutral-700/60 rounded-2xl p-4 border border-amber-600">
                        <div class="mx-auto h-6 w-6 rounded-sm bg-yellow-600"></div>
                        <div class="mt-2 text-sm">VIP</div>
                        <div class="text-xs text-neutral-300">{{ $showtime->base_price + 60 }} THB</div>
                    </div>
                </div>
            </div>

            <div class="bg-neutral-800 rounded-2xl p-6">
                <div class="flex gap-4">
                    <img src="{{ $showtime->movie->poster_url }}" class="w-24 h-32 object-cover rounded" />
                    <div>
                        <div class="text-neutral-300">{{ $showtime->movie->title }}</div>
                        <div class="text-xs text-neutral-400">{{ $showtime->movie->language }}</div>
                    </div>
                </div>
                <div class="mt-6">
                    <div class="text-neutral-400 text-sm">รอบฉาย</div>
                    <div class="text-lg font-semibold">Theatre {{ $showtime->theater->screen_number ?? $showtime->theater->id }}</div>
                    <div class="mt-2">
                        <span class="inline-block bg-white/90 text-black px-3 py-1 rounded-full text-sm">{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}</span>
                    </div>
                </div>

                <div class="mt-6 border-t border-neutral-700 pt-4">
                    <div class="text-sm text-neutral-400">ที่นั่งที่เลือก</div>
                    <div class="mt-1 text-white">
                        @php
                            $seats = $showtime->theater->seats->whereIn('id', $selectedSeats);
                            $total = 0;
                        @endphp
                        @forelse($seats as $s)
                            @php $price = $showtime->base_price + $s->price_delta; $total += $price; @endphp
                            <div class="flex justify-between text-sm">
                                <span>{{ $s->row }}{{ $s->number }}</span>
                                <span>{{ $price }} THB</span>
                            </div>
                        @empty
                            <div class="text-neutral-500">ยังไม่ได้เลือก</div>
                        @endforelse
                        <div class="flex justify-between font-semibold mt-2">
                            <span>Total</span><span>{{ $total }} THB</span>
                        </div>
                    </div>
                    <x-input-error for="selected" class="mt-2" />
                    <button wire:click="book" class="mt-4 w-full bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg">ชำระเงินและยืนยัน</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* 18 columns for seat grid */
.grid-cols-18{grid-template-columns: repeat(18, minmax(0,1fr));}
</style>
