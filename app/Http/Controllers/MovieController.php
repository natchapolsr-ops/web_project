<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of movies.
     */
    public function index()
    {
        // use centralized movie data so each card can link to its own detail
        $movies = array_values($this->movies());

        return view('movies', compact('movies'));
    }

    /**
     * Show movie detail page.
     */
    public function show($id)
    {
        $movies = $this->movies();

        if (! isset($movies[$id])) {
            abort(404);
        }

        $movie = $movies[$id];

        return view('movie_detail', compact('movie'));
    }

    /**
     * Centralized movie dataset (temporary - replace with DB later)
     * Keyed array by id so show() can lookup easily.
     */
    private function movies()
    {
        return [
            1 => [
                'id' => 1,
                'title' => 'REQUEST',
                'date' => '03 September 2024',
                'time' => '14:00-16:00',
                'genre' => 'action',
                'poster' => 'https://picsum.photos/seed/request/240/300',
                'synopsis' => "ในโลกที่ความมืดครอบงำ เมืองทั้งเมืองถูกปกคลุมด้วยอาชญากรรมและความโกลาหล\nอัศวินดำ นักล่าที่ไร้ชื่อ ได้กลับมาอีกครั้ง..."
            ],
            2 => [
                'id' => 2,
                'title' => 'Inception',
                'date' => '16 July 2010',
                'time' => '18:00-20:30',
                'genre' => 'sci-fi',
                'poster' => 'https://picsum.photos/seed/inception/240/300',
                'synopsis' => "A thief who steals corporate secrets through use of dream-sharing technology..."
            ],
            3 => [
                'id' => 3,
                'title' => 'Parasite',
                'date' => '30 May 2019',
                'time' => '20:00-22:15',
                'genre' => 'drama',
                'poster' => 'https://picsum.photos/seed/parasite/240/300',
                'synopsis' => "A darkly comic tale about class conflict and a family's infiltration..."
            ],
            // fill remaining slots with generic placeholders
            /**4 => ['id'=>4,'title'=>'Movie 4','date'=>'2023','time'=>'16:00','genre'=>'drama','poster'=>'https://picsum.photos/seed/m4/240/300','synopsis'=>'Synopsis 4'],
            5 => ['id'=>5,'title'=>'Movie 5','date'=>'2023','time'=>'16:00','genre'=>'action','poster'=>'https://picsum.photos/seed/m5/240/300','synopsis'=>'Synopsis 5'],
            6 => ['id'=>6,'title'=>'Movie 6','date'=>'2023','time'=>'16:00','genre'=>'adventure','poster'=>'https://picsum.photos/seed/m6/240/300','synopsis'=>'Synopsis 6'],
            7 => ['id'=>7,'title'=>'Movie 7','date'=>'2023','time'=>'16:00','genre'=>'fantasy','poster'=>'https://picsum.photos/seed/m7/240/300','synopsis'=>'Synopsis 7'],
            8 => ['id'=>8,'title'=>'Movie 8','date'=>'2023','time'=>'16:00','genre'=>'horror','poster'=>'https://picsum.photos/seed/m8/240/300','synopsis'=>'Synopsis 8'],
            9 => ['id'=>9,'title'=>'Movie 9','date'=>'2023','time'=>'16:00','genre'=>'thriller','poster'=>'https://picsum.photos/seed/m9/240/300','synopsis'=>'Synopsis 9'],
            10 => ['id'=>10,'title'=>'Movie 10','date'=>'2023','time'=>'16:00','genre'=>'animation','poster'=>'https://picsum.photos/seed/m10/240/300','synopsis'=>'Synopsis 10'],*/
        ];
    }
}
