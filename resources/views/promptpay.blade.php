<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PromptPay Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <h2>ชำระด้วย PromptPay (สแกน QR)</h2>

                @if($errors->any())
                    <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
                        {{ $errors->first('payment') }}
                    </div>
                @endif

                @if($qrUrl)
                    <p>กรุณาสแกน QR ด้วยแอปธนาคารของคุณ</p>
                    <img src="{{ $qrUrl }}" alt="PromptPay QR code" style="max-width:320px;">
                    <p>สถานะชำระ: {{ $charge['status'] ?? 'pending' }}</p>

                    <div class="mt-4">
                        <a href="{{ route('payment.status', ['id' => $charge['id']]) }}"
                           class="bg-blue-500 text-white px-4 py-2 rounded">
                           เช็กสถานะการชำระ
                        </a>
                    </div>
                @else
                    <p>ไม่พบ QR code — เกิดข้อผิดพลาด</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
