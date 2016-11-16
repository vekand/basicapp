<?php

use Illuminate\Database\Seeder;
use App\Tipcourse;
class TipcourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipcourse = new Tipcourse();
        $tipcourse->name = 'Beginner';
        $tipcourse->description = 'Beginner Course';
        $tipcourse->save();

        $tipcourse = new Tipcourse();
        $tipcourse->name = 'Advanced';
        $tipcourse->description = 'Advanced Course';
        $tipcourse->save();
    }
}
