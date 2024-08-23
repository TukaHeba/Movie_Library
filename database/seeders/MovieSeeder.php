<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Movie::truncate();
        Movie::create([
            'title' => 'title1',
            'director' => 'director1',
            'genre' => 'action',
            'release_year' => '2000',
            'description' => 'description1',
        ]);
        Movie::create([
            'title' => 'title2',
            'director' => 'director2',
            'genre' => 'drama',
            'release_year' => '2002',
            'description' => 'description2',
        ]);
        Movie::create([
            'title' => 'title3',
            'director' => 'director3',
            'genre' => 'comedy',
            'release_year' => '2003',
            'description' => 'description3',
        ]);
        Movie::create([
            'title' => 'title4',
            'director' => 'director4',
            'genre' => 'science_fiction',
            'release_year' => '2004',
            'description' => 'description4',
        ]);
    }
}
