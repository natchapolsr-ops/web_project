<?php

namespace App\Http\Livewire\Movies;

use App\Models\Movie;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.movies.index', [
            'movies' => Movie::latest()->get(),
        ])->layout('layouts.guest');
    }
}
