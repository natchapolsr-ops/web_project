<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // แสดงรายการ booking ทั้งหมด
    public function index()
    {
        $bookings = Booking::all();
        return view('bookings.index', compact('bookings'));
    }

    // แสดงรายละเอียด booking
    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    // ตัวอย่างสำหรับสร้าง booking ใหม่
    public function store(Request $request)
    {
        $booking = Booking::create($request->all());
        return redirect()->route('bookings.show', $booking);
    }

    // ตัวอย่างสำหรับอัปเดต booking
    public function update(Request $request, Booking $booking)
    {
        $booking->update($request->all());
        return redirect()->route('bookings.show', $booking);
    }

    // ตัวอย่างสำหรับลบ booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index');
    }
}
