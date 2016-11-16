<?php

use Illuminate\Database\Seeder;
use App\About;
class AboutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$about = new About();
    	$about->title = 'Despre mine';
    	$about->body = 'Eu sint...';
    	$about->foto1 = '';
    	$about->foto2 = '';
    	$about->foto3 = '';
    	$about->foto4 = '';
    	$about->foto5 = '';
        $about->prof_id = 1;
    	$about->save();

        $about = new About();
        $about->title = 'Despre mine';
        $about->body = 'Eu sint...';
        $about->foto1 = '';
        $about->foto2 = '';
        $about->foto3 = '';
        $about->foto4 = '';
        $about->foto5 = '';
        $about->prof_id = 2;
        $about->save();

        $about = new About();
        $about->title = 'Despre mine';
        $about->body = 'Eu sint...';
        $about->foto1 = '';
        $about->foto2 = '';
        $about->foto3 = '';
        $about->foto4 = '';
        $about->foto5 = '';
        $about->prof_id = 3;
        $about->save();

        /*$about = new About();
        $about->title = 'Despre mine';
        $about->body = 'Eu sint...';
        $about->foto1 = '';
        $about->foto2 = '';
        $about->foto3 = '';
        $about->foto4 = '';
        $about->foto5 = '';
        $about->prof_id = 4;
        $about->save();*/
    }
}
