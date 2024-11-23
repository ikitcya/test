<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run()
    {
        DB::table('movies')->insert([
            ['title' => 'Movie 1', 'is_published' => false, 'poster' => 'default_poster.jpg'],
            ['title' => 'Movie 2', 'is_published' => true, 'poster' => 'default_poster.jpg'],
        ]);

        DB::table('movie_genre')->insert([
            ['movie_id' => 1, 'genre_id' => 1],
            ['movie_id' => 1, 'genre_id' => 2],
            ['movie_id' => 2, 'genre_id' => 3],
        ]);
    }
}
