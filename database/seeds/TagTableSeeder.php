<?php

use Illuminate\Database\Seeder;
use App\Tag;
class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Tag();
        $category->name = 'Sah';
        $category->save();
        $category = new Tag();
        $category->name = 'Incepatori';
        $category->save();
        $category = new Tag();
        $category->name = 'Avansati';
        $category->save();
    }
}
