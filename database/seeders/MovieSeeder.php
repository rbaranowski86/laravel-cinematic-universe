<?php

namespace Database\Seeders;

use App\Models\CinematicUniverse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mcu = CinematicUniverse::where('name', 'Marvel Cinematic Universe')->first();

        $movies = [
            ['title' => 'Iron Man', 'releaseDate' => '2008-05-02', 'director' => 'Jon Favreau', 'boxOfficeEarnings' => 585174222],
            ['title' => 'Thor', 'releaseDate' => '2011-05-06', 'director' => 'Kenneth Branagh', 'boxOfficeEarnings' => 449326618],
            ['title' => 'Captain America: The First Avenger', 'releaseDate' => '2011-07-22', 'director' => 'Joe Johnston', 'boxOfficeEarnings' => 370569774],
            ['title' => 'The Avengers', 'releaseDate' => '2012-05-04', 'director' => 'Joss Whedon', 'boxOfficeEarnings' => 1518812988],
            ['title' => 'Guardians of the Galaxy', 'releaseDate' => '2014-08-01', 'director' => 'James Gunn', 'boxOfficeEarnings' => 773328629],
            ['title' => 'Avengers: Age of Ultron', 'releaseDate' => '2015-05-01', 'director' => 'Joss Whedon', 'boxOfficeEarnings' => 1405403694],
            ['title' => 'Captain America: Civil War', 'releaseDate' => '2016-05-06', 'director' => 'Anthony and Joe Russo', 'boxOfficeEarnings' => 1153296293],
            ['title' => 'Doctor Strange', 'releaseDate' => '2016-11-04', 'director' => 'Scott Derrickson', 'boxOfficeEarnings' => 677718395],
            ['title' => 'Black Panther', 'releaseDate' => '2018-02-16', 'director' => 'Ryan Coogler', 'boxOfficeEarnings' => 1346913161],
            ['title' => 'Avengers: Infinity War', 'releaseDate' => '2018-04-27', 'director' => 'Anthony and Joe Russo', 'boxOfficeEarnings' => 2048359754],
            ['title' => 'Avengers: Endgame', 'releaseDate' => '2019-04-26', 'director' => 'Anthony and Joe Russo', 'boxOfficeEarnings' => 2797800564]
        ];

        foreach ($movies as $movie) {
            $mcu->movies()->create($movie);
        }
    }
}
