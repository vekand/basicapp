<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProfTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(LevelTableSeeder::class);
        $this->call(TipcourseTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AgeTableSeeder::class);
        $this->call(CarouselTableSeeder::class);
        $this->call(AboutTableSeeder::class);
        $this->call(HomeTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(TagTableSeeder::class);
        
    }
}
