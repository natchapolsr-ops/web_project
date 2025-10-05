<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
    // ...existing code...
        // ...existing code...
        // ภาพยนตร์หลัก
        $movie = Movie::updateOrCreate([
            'title' => 'Request',
        ], [
            'language' => 'TH/EN',
            'genre' => 'action',
            'poster_url' => 'poster1.png',
            'description' => 'ในโลกที่ความมืดครอบงำ ... คำร้องครั้งสุดท้ายกำลังเริ่มต้น',
        ]);

        // โรงภาพยนตร์
        $theater = Theater::updateOrCreate([
            'name' => 'Theatre 8',
        ], [
            'screen_number' => 8,
            'rows' => 11, // VP + A..K
            'cols' => 18,
        ]);

        // =========================
        // หนังเรื่องที่ 1
        // =========================
            $movieA = Movie::updateOrCreate([
                'title' => 'Superhero Movie',
            ], [
                'poster_url' => 'poster3.png',
                'language' => 'EN',
                'genre' => 'comedy',
                'description' => 'ภาพยนตร์เล่าถึงหนุ่มมัธยมชื่อ ริค ไรเกอร์ (Rick Riker)...',
            ]);

        Showtime::updateOrCreate([
            'movie_id' => $movieA->id,
            'theater_id' => $theater->id,
            'show_date' => '2025-10-10',
            'start_time' => '18:00:00',
        ], [
            'end_time' => '20:00:00',
            'base_price' => 120,
        ]);

        // =========================
        // หนังเรื่องที่ 2
        // =========================
            $movieB = Movie::updateOrCreate([
                'title' => 'scmill',
            ], [
                'poster_url' => 'poster4.png',
                'language' => 'EN',
                'genre' => 'action',
                'description' => 'เรื่องย่อ scmill',
            ]);

        Showtime::updateOrCreate([
            'movie_id' => $movieB->id,
            'theater_id' => $theater->id,
            'show_date' => '2025-10-11',
            'start_time' => '19:00:00',
        ], [
            'end_time' => '21:00:00',
            'base_price' => 150,
        ]);

        // =========================
        // ที่นั่งในโรง
        // =========================
        $rows = array_merge(['VP'], range('A', 'K'));
        $typesMap = [
            'VP' => ['type' => 'vip', 'delta' => 60],
            'B' => ['type' => 'honeymoon', 'delta' => 20],
            'C' => ['type' => 'honeymoon', 'delta' => 20],
        ];

        foreach ($rows as $row) {
            for ($i = 1; $i <= 18; $i++) {
                $meta = $typesMap[$row] ?? ['type' => 'normal', 'delta' => 0];
                Seat::firstOrCreate([
                    'theater_id' => $theater->id,
                    'row' => $row,
                    'number' => $i,
                ], [
                    'type' => $meta['type'],
                    'price_delta' => $meta['delta'],
                ]);
            }
        }

        // =========================
        // หนัง Request (จากด้านบน)
        // =========================
        Showtime::updateOrCreate([
            'movie_id' => $movie->id,
            'theater_id' => $theater->id,
            'show_date' => now()->toDateString(),
            'start_time' => '14:00:00',
        ], [
            'end_time' => '16:00:00',
            'base_price' => 99,
        ]);

        // =========================
        // หนังเรื่องสุดท้าย
        // =========================
            $movie2 = Movie::updateOrCreate([
                'title' => 'The king of colosseum',
            ], [
                'language' => 'TH',
                'genre' => 'drama',
                'poster_url' => 'poster2.png',
                'description' => 'เรื่องย่อของ The king of colosseum',
            ]);

        Showtime::updateOrCreate([
            'movie_id' => $movie2->id,
            'theater_id' => $theater->id,
            'show_date' => now()->toDateString(),
            'start_time' => '18:00:00',
        ], [
            'end_time' => '20:00:00',
            'base_price' => 120,
        ]);
        // เพิ่ม showtime ให้กับหนังทุกเรื่องในระบบ (เฉพาะที่ยังไม่มี showtime)
        foreach (Movie::all() as $movie) {
            if ($movie->showtimes()->exists()) continue;
            Showtime::updateOrCreate([
                'movie_id' => $movie->id,
                'theater_id' => $theater->id,
                'show_date' => now()->toDateString(),
                'start_time' => '17:00:00',
            ], [
                'end_time' => '19:00:00',
                'base_price' => 120,
            ]);
        }
    }
}
