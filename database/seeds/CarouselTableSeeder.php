<?php

use Illuminate\Database\Seeder;
use App\Carousel;


class CarouselTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carousel = new Carousel();
        $carousel->title = 'Caissa Park';
        $carousel->img = '';
        $carousel->body = 'Chess activity';
        $carousel->readmore = '';
        $carousel->save();

        $carousel = new Carousel();
        $carousel->title = 'The future of chess';
        $carousel->img = '';
        $carousel->body = 'Chess in nature';
        $carousel->readmore = '';
        $carousel->save();

        $carousel = new Carousel();
        $carousel->title = 'Chess sunset';
        $carousel->img = '';
        $carousel->body = 'Chess in garden';
        $carousel->readmore = '';
        $carousel->save();

        $carousel = new Carousel();
        $carousel->title = 'Chess contest';
        $carousel->img = '';
        $carousel->body = 'Chess in brain';
        $carousel->readmore = '';
        $carousel->save();

        $carousel = new Carousel();
        $carousel->title = 'Welcome in the space!';
        $carousel->img = '';
        $carousel->body = 'Icon';
        $carousel->readmore = '';
        $carousel->save();

        $carousel = new Carousel();
        $carousel->title = 'Chess principle';
        $carousel->img = '';
        $carousel->body = 'Reference';
        $carousel->readmore = '';
        $carousel->save();
    }
}
