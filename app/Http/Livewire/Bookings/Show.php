<?php

namespace App\Http\Livewire\Bookings;

use App\Models\Booking;
use Livewire\Component;

class Show extends Component
{
    public Booking $booking;

    public function mount(Booking $booking)
    {
        $this->booking = $booking->load('showtime.movie','showtime.theater','seats');
    }

    public function render()
    {
        return view('livewire.bookings.show')->layout('layouts.guest');
    }
}
