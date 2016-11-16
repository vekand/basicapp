<?php

use Illuminate\Database\Seeder;
use App\Level;
class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = new Level();
        $level->name = 'Beginner';
        $level->description = 'Beginner Level';
        $level->save();

        $level = new Level();
        $level->name = 'Advanced';
        $level->description = 'Advanced Level';
        $level->save();
    }
}
