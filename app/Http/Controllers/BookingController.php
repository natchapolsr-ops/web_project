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
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|array|min:1',
            'seats.*' => 'exists:seats,id',
        ]);

        $showtime = \App\Models\Showtime::findOrFail($request->showtime_id);
        $seats = \App\Models\Seat::whereIn('id', $request->seats)->where('theater_id', $showtime->theater_id)->get();
        $total = 0;
        $seatData = [];
        foreach ($seats as $seat) {
            $price = $showtime->base_price + $seat->price_delta;
            $total += $price;
            $seatData[$seat->id] = ['price' => $price];
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'showtime_id' => $showtime->id,
            'status' => 'paid',
            'total_amount' => $total,
        ]);
        $booking->seats()->attach($seatData);

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
