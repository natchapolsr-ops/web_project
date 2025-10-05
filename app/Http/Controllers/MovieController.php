<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    // แสดงรายการหนังทั้งหมด
    public function index()
    {
        $movies = Movie::all();
        return view('movies.index', compact('movies'));
    }

    // แสดงรายละเอียดหนัง
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    // ตัวอย่างสำหรับสร้างหนังใหม่
    public function store(Request $request)
    {
        $movie = Movie::create($request->all());
        return redirect()->route('movies.show', $movie);
    }

    // ตัวอย่างสำหรับอัปเดตหนัง
    public function update(Request $request, Movie $movie)
    {
        $movie->update($request->all());
        return redirect()->route('movies.show', $movie);
    }

    // ตัวอย่างสำหรับลบหนัง
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index');
    }
}
