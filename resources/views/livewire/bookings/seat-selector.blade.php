<div class="min-h-screen bg-neutral-900 text-black py-10">
    <div class="max-w-7xl mx-auto py-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-neutral-800/60 rounded-xl p-6 relative">
                <div class="text-center mb-6">
                    <div class="inline-block border border-amber-500 px-6 py-2 rounded">SCREEN</div>
                </div>

                @php
                    // หา seat id ที่ถูกจองแล้วใน showtime นี้
                    $bookedSeatIds = $showtime->bookings()->with('seats')->get()->flatMap->seats->pluck('id')->unique()->toArray();
                    $totalSeats = $showtime->theater->seats->count();
                    $availableSeats = $totalSeats - count($bookedSeatIds);
                @endphp
                <div class="mb-4 text-right text-sm text-neutral-300">
                    เหลือที่นั่ง {{ $availableSeats }} / {{ $totalSeats }}
                </div>
                <form method="POST" action="{{ route('bookings.store') }}">
                    @csrf
                    <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                    <div class="space-y-2">
                        @foreach($seatRows as $rowLabel => $row)
                            @php
                                // หา type หลักของแถวนี้ (ใช้ type ของที่นั่งตัวแรกในแถว)
                                $rowType = $row[0]->type ?? 'normal';
                                $typeLabel = [
                                    'normal' => 'Normal',
                                    'honeymoon' => 'Honeymoon',
                                    'vip' => 'VIP',
                                    'opera' => 'Opera',
                                    'disabled' => 'Disabled',
                                ][$rowType] ?? ucfirst($rowType);
                            @endphp
                            <div class="flex items-center gap-4">
                                <div class="w-20 text-xs text-neutral-400 flex flex-col items-center justify-center">
                                    <span class="font-bold text-base leading-none">{{ $rowLabel }}</span>
                                    <span class="text-[11px] text-neutral-500 mt-1">{{ $typeLabel }}</span>
                                </div>
                                <div class="grid grid-cols-18 gap-2 flex-1">
                                    @foreach($row as $seat)
                                        @php
                                            $isSelected = old('seats', []) && in_array($seat->id, old('seats', []));
                                            $isBooked = in_array($seat->id, $bookedSeatIds);
                                        @endphp
                                        <label class="flex items-center justify-center {{ $isBooked ? 'opacity-30 pointer-events-none' : '' }} {{ $seat->type == 'disabled' ? 'opacity-50 pointer-events-none' : '' }}" title="{{ $rowLabel }}{{ $seat->number }}{{ $isBooked ? ' (จองแล้ว)' : '' }}">
                                            <input type="checkbox" name="seats[]" value="{{ $seat->id }}" data-price="{{ $showtime->base_price + $seat->price_delta }}" class="seat-checkbox" @if($isSelected) checked @endif @if($seat->type == 'disabled' || $isBooked) disabled @endif>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="w-20 text-xs text-neutral-400 flex flex-col items-center justify-center">
                                    <span class="font-bold text-base leading-none">{{ $rowLabel }}</span>
                                    <span class="text-[11px] text-neutral-500 mt-1">{{ $typeLabel }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 grid grid-cols-3 gap-4">
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
                            <div class="mx-auto h-6 w-6 rounded-sm bg-yellow-600"></div>
                            <div class="mt-2 text-sm">VIP</div>
                            <div class="text-xs text-neutral-300">{{ $showtime->base_price + 60 }} THB</div>
                        </div>
                    </div>
                    <div class="mt-6 border-t border-neutral-700 pt-4">
                        <div class="text-sm text-neutral-400">ที่นั่งที่เลือก</div>
                        <div class="mt-1 text-black">
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
                                <span>Total</span><span id="total-price">{{ $total }} THB</span>
                            </div>
                        </div>
                        @error('seats')
                            <div class="text-red-500 text-xs mt-2">{{ $message }}</div>
                        @enderror
                        <button type="submit" class="mt-4 w-full bg-amber-600 hover:bg-amber-500 text-black px-4 py-2 rounded-lg">ชำระเงินและยืนยัน</button>
                    </div>
                </form>
            </div>

            <div class="bg-neutral-800 rounded-2xl p-6">
                <div class="flex gap-4">
                    @php
                        $poster = $showtime->movie->poster_url
                            ? (Str::startsWith($showtime->movie->poster_url, ['http://','https://','/'])
                                ? $showtime->movie->poster_url
                                : asset('images/' . ltrim($showtime->movie->poster_url, '/')))
                            : asset('images/default.png');
                    @endphp
                    <img src="{{ $poster }}" class="w-24 h-32 object-cover rounded" />
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
                    {{-- ตัดส่วนแสดงที่นั่งที่เลือกและ Total ฝั่งขวาออก --}}
                </div>
            </div>
        </div>
    </div>
    <style>
    /* 18 columns for seat grid */
    .grid-cols-18{grid-template-columns: repeat(18, minmax(0,1fr));}
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.seat-checkbox:checked').forEach(cb => {
                total += parseInt(cb.getAttribute('data-price')) || 0;
            });
            document.getElementById('total-price').textContent = total + ' THB';
        }
        document.querySelectorAll('.seat-checkbox').forEach(cb => {
            cb.addEventListener('change', updateTotal);
        });
        updateTotal();
    });
    </script>
</div>
