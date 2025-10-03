<?php

namespace App\Http\Livewire\Bookings;

use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SeatSelector extends Component
{
    public Showtime $showtime;
    public array $selected = [];

    public function mount(Showtime $showtime)
    {
        $this->showtime = $showtime->load(['theater.seats','movie']);
    }

    public function toggleSeat(int $seatId): void
    {
        if (in_array($seatId, $this->selected)) {
            $this->selected = array_values(array_diff($this->selected, [$seatId]));
        } else {
            $this->selected[] = $seatId;
        }
    }

    public function book()
    {
        if (empty($this->selected)) {
            $this->addError('selected', 'Please select at least 1 seat.');
            return;
        }

        $seats = Seat::whereIn('id', $this->selected)->where('theater_id', $this->showtime->theater_id)->get();
        $total = 0;
        foreach ($seats as $s) {
            $total += $this->showtime->base_price + $s->price_delta;
        }

        $booking = DB::transaction(function () use ($seats, $total) {
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'showtime_id' => $this->showtime->id,
                'status' => 'paid', // demo
                'total_amount' => $total,
            ]);
            foreach ($seats as $s) {
                $booking->seats()->attach($s->id, [
                    'price' => $this->showtime->base_price + $s->price_delta,
                ]);
            }
            return $booking;
        });

        return redirect()->route('bookings.show', $booking);
    }

    public function render()
    {
        $theater = $this->showtime->theater;
        $seats = $theater->seats()->orderBy('row')->orderBy('number')->get()->groupBy('row');
        $selectedSeats = collect($this->selected);
        return view('livewire.bookings.seat-selector', [
            'seatRows' => $seats,
            'selectedSeats' => $selectedSeats,
        ])->layout('layouts.guest');
    }
}
