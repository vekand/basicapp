<?php

use Illuminate\Database\Seeder;
use App\Home;
class HomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $about = new Home();
    	$about->title = 'Chess Universe is part of the Natural Universe';
    	$about->body = 'Thank you so much for visiting. This is my website built for my chess activity. Please read more';
    	$about->foto1 = '';
    	$about->foto2 = '';
    	$about->foto3 = '';
    	$about->foto4 = '';
    	$about->foto5 = '';
    	$about->save();
    }
}
