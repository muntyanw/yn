<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run()
    {
        News::create([
            'date' => Carbon::now()->format('Y-m-d'),
            'time' => Carbon::now()->format('H:i:s'),
            'title' => 'Заголовок новини 1',
            'short_content' => 'Це короткий зміст новини 1.',
            'full_content' => 'Це повний зміст новини 1.',
            'photo' => 'news_photos/photo1.jpg'
        ]);

        News::create([
            'date' => Carbon::now()->subDay()->format('Y-m-d'),
            'time' => Carbon::now()->subDay()->format('H:i:s'),
            'title' => 'Заголовок новини 2',
            'short_content' => 'Це короткий зміст новини 2.',
            'full_content' => 'Це повний зміст новини 2.',
            'photo' => 'news_photos/photo2.jpg'
        ]);

        News::create([
            'date' => Carbon::now()->subDays(2)->format('Y-m-d'),
            'time' => Carbon::now()->subDays(2)->format('H:i:s'),
            'title' => 'Заголовок новини 3',
            'short_content' => 'Це короткий зміст новини 3.',
            'full_content' => 'Це повний зміст новини 3.',
            'photo' => 'news_photos/photo3.jpg'
        ]);
    }
}
