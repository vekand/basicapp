<?php

use Illuminate\Database\Seeder;
use App\Category;
class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = 'Sport';
        $category->save();
        $category = new Category();
        $category->name = 'Sah';
        $category->save();
        $category = new Category();
        $category->name = 'Diverse';
        $category->save();
    }
}
