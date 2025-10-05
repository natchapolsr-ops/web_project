<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Theater;
use App\Models\Seat;
use App\Models\Showtime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        $movie = Movie::updateOrCreate([
            'title' => 'Request',
        ], [
            'name' => 'Request',
            'language' => 'TH/EN',
            'genre' => 'action',
            'poster_url' => 'https://i.imgur.com/5y8H9nK.jpeg',
            'description' => 'ในโลกที่ความมืดครอบงำ ... คำร้องครั้งสุดท้ายกำลังเริ่มต้น',
        ]);

        $theater = Theater::updateOrCreate([
            'name' => 'Theatre 8',
        ], [
            'screen_number' => 8,
            'rows' => 11, // VP + A..K
            'cols' => 18,
        ]);

        // Build rows: VP, A..K
        $rows = array_merge(['VP'], range('A','K'));
        $typesMap = [
            'VP' => ['type' => 'vip', 'delta' => 60],
            'A' => ['type' => 'opera', 'delta' => 300],
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

        Showtime::updateOrCreate([
            'movie_id' => $movie->id,
            'theater_id' => $theater->id,
            'show_date' => now()->toDateString(),
            'start_time' => '14:00:00',
        ], [
            'end_time' => '16:00:00',
            'base_price' => 99,
        ]);

        // เพิ่มหนังอีกเรื่อง (id=2) พร้อม showtime
        $movie2 = Movie::updateOrCreate([
            'title' => 'The king of collosium',
        ], [
            'name' => 'The king of collosium',
            'language' => 'TH',
            'genre' => 'drama',
            'poster_url' => 'poster2.png',
            'description' => 'เรื่องย่อของ The king of collosium',
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
    }
}

?>