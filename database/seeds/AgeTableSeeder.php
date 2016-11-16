<?php

use Illuminate\Database\Seeder;
use App\Age;
class AgeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $age = new Age();
        $age->category = 'open';
        $age->save();

        $age = new Age();
        $age->category = 'B08';
        $age->save();

        $age = new Age();
        $age->category = 'B10';
        $age->save();
                $age = new Age();
        $age->category = 'B12';
        $age->save();
                $age = new Age();
        $age->category = 'B14';
        $age->save();
                $age = new Age();
        $age->category = 'B16';
        $age->save();
                $age = new Age();
        $age->category = 'B18';
        $age->save();
                $age = new Age();
        $age->category = 'f08';
        $age->save();
                $age = new Age();
        $age->category = 'F10';
        $age->save();
                $age = new Age();
        $age->category = 'F12';
        $age->save();
                       $age = new Age();
        $age->category = 'F14';
        $age->save();
                       $age = new Age();
        $age->category = 'F16';
        $age->save();
                       $age = new Age();
        $age->category = 'F18';
        $age->save();
                       $age = new Age();
        $age->category = 'veteran';
        $age->save();
                       $age = new Age();
        $age->category = 'pensionar';
        $age->save();
    }
}
