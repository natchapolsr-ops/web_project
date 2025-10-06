<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>PromptPay Payment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-12 bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-4">ชำระด้วย PromptPay (สแกน QR)</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-2 mb-3 rounded">
                {{ $errors->first('payment') }}
            </div>
        @endif

        @if($qrUrl)
            <p class="mb-2">กรุณาสแกน QR ด้วยแอปธนาคารของคุณ</p>
            <img src="{{ $qrUrl }}" alt="PromptPay QR code" class="max-w-xs mx-auto">
            <p class="mt-3">สถานะชำระ: {{ $charge['status'] ?? 'pending' }}</p>

            <div class="mt-4 text-center">
                <a href="{{ route('payment.status', ['id' => $charge['id']]) }}"
                   class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                   เช็กสถานะการชำระ
                </a>
            </div>
        @else
            <p>ไม่พบ QR code — เกิดข้อผิดพลาด</p>
        @endif
    </div>
</body>
</html>
