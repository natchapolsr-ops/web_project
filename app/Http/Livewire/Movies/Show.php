<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use Livewire\Component;

class Show extends Component
{
    public Movie $movie;

    public function mount(Movie $movie): void
    {
        $this->movie = $movie->load('showtimes.theater');
    }

    public function render()
    {
        return view('livewire.movies.show')->layout('layouts.guest');
    }
}
