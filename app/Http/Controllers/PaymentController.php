<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    // ✅ สร้าง PromptPay Charge
    public function createPromptpayCharge()
    {
        define('OMISE_API_VERSION', config('services.omise.api_version'));
        define('OMISE_PUBLIC_KEY', config('services.omise.public_key'));
        define('OMISE_SECRET_KEY', config('services.omise.private_key'));

        try {
            // 1) สร้าง Source (PromptPay)
            $source = \OmiseSource::create([
                'type'     => 'promptpay',
                'amount'   => 10000, // 100.00 บาท
                'currency' => 'thb',
            ]);

            // 2) สร้าง Charge
            $charge = \OmiseCharge::create([
                'amount'      => 10000,
                'currency'    => 'thb',
                'source'      => $source['id'],
                'return_uri'  => url('/dashboard'),
                'description' => 'Movie Ticket Payment',
            ]);

            // 3) เก็บข้อมูลใน DB
            Payment::create([
                'charge_id' => $charge['id'],
                'amount'    => $charge['amount'],
                'status'    => $charge['status'],
            ]);

            $qrUrl = $charge['source']['scannable_code']['image']['download_uri'] ?? null;

            return view('promptpay', [
                'qrUrl'  => $qrUrl,
                'charge' => $charge,
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['payment' => $e->getMessage()]);
        }
    }

    // ✅ เช็กสถานะการจ่าย
    public function checkStatus($id)
    {
        define('OMISE_API_VERSION', config('services.omise.api_version'));
        define('OMISE_PUBLIC_KEY', config('services.omise.public_key'));
        define('OMISE_SECRET_KEY', config('services.omise.private_key'));

        try {
            $charge = \OmiseCharge::retrieve($id);

            // update DB
            $payment = Payment::where('charge_id', $id)->first();
            if ($payment) {
                $payment->update(['status' => $charge['status']]);
            }

            $qrUrl = $charge['source']['scannable_code']['image']['download_uri'] ?? null;

            return view('promptpay', [
                'qrUrl'  => $qrUrl,
                'charge' => $charge,
            ]);

        } catch (\Exception $e) {
            return back()->withErrors(['payment' => $e->getMessage()]);
        }
    }

    // ✅ Webhook (สำหรับ Production)
    public function handleWebhook(Request $request)
{
    $payload = $request->all();

    // ตรวจสอบว่าเป็น event charge.complete
    if (($payload['key'] ?? null) === 'charge.complete') {
        $charge = $payload['data'];

        // ดึงสถานะ
        $status = $charge['status']; // successful / failed / pending
        $chargeId = $charge['id'];

        // TODO: อัพเดท database ของ booking ว่า "จ่ายเงินแล้ว"
        \Log::info("Omise Webhook: Charge {$chargeId} is {$status}");

        return response()->json(['message' => 'Webhook processed']);
    }

    return response()->json(['message' => 'Ignored'], 200);
}
}
