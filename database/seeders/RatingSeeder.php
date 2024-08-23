<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            'user_id' => '1',
            'movie_id' => '1',
            'rating' => '4',
            'review' => 'good',
        ]);
        Rating::create([
            'user_id' => '1',
            'movie_id' => '2',
            'rating' => '1',
            'review' => 'bad',
        ]);
        Rating::create([
            'user_id' => '1',
            'movie_id' => '3',
            'rating' => '5',
            'review' => 'wow',
        ]);
        Rating::create([
            'user_id' => '1',
            'movie_id' => '4',
            'rating' => '4',
            'review' => 'good',
        ]);
        Rating::create([
            'user_id' => '2',
            'movie_id' => '1',
            'rating' => '1',
            'review' => 'bad',
        ]);
        Rating::create([
            'user_id' => '2',
            'movie_id' => '2',
            'rating' => '4',
            'review' => 'good',
        ]);
    }
}
