<?php

use Illuminate\Database\Seeder;
use App\Location;
class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = new Location();
        $level->name = 'Local';
        $level->description = 'Local school';
        $level->save();

        $level = new Location();
        $level->name = 'Extern';
        $level->description = 'Other schools';
        $level->save();
    }
}
