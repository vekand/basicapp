<?php

use Illuminate\Database\Seeder;
use App\Prof;
class ProfTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
        // prof1

        $prof = new Prof();
        $prof->first_name = 'Andrei';
        $prof->last_name = 'Andrei';
        $prof->nick_name = 'andrei';
        $prof->email = 'andrei_veklinec@example.com';
        $prof->adresa = 'local';
        $prof->oras = 'local';
        $prof->scoala = 'local';
        $prof->activ = 0;
        $prof->blog = 0;
        $prof->text = 'Andrei';
        $prof->save();

    	/*$prof = new Prof();
        $prof->first_name = 'George Catalin';
        $prof->last_name = 'Ardelean';
        $prof->nick_name = 'catalin';
        $prof->email = 'catalin@yahoo.com';
        $prof->adresa = 'local';
        $prof->oras = 'local';
        $prof->scoala = 'local';
        $prof->activ = 1;
        $prof->blog = 1;
        $prof->text = 'Catalin';
        $prof->save();*/

// prof2

        $prof = new Prof();
        $prof->first_name = 'Petre';
        $prof->last_name = 'Nad Titus';
        $prof->nick_name = 'nadtitus';
        $prof->email = 'petrenadtitus@example.com';
        $prof->adresa = 'local';
        $prof->oras = 'local';
        $prof->scoala = 'local';
        $prof->activ = 1;
        $prof->blog = 1;
        $prof->text = 'Petre';
        $prof->save();

        /*$prof = new Prof();
        $prof->first_name = 'Ciprian';
        $prof->last_name = 'Muntean';
        $prof->nick_name = 'cipri';
        $prof->adresa = 'local';
        $prof->oras = 'local';
        $prof->scoala = 'local';
        $prof->activ = 1;
        $prof->blog = 1;
        $prof->text = 'Cipri';
        $prof->save();*/

        /*$prof = new Prof();
        $prof->first_name = 'Zoltan';
        $prof->last_name = 'Pall';
        $prof->nick_name = 'zoli';
        $prof->email = 'zoli@example.com';
        $prof->adresa = 'local';
        $prof->oras = 'local';
        $prof->scoala = 'local';
        $prof->activ = 0;
        $prof->blog = 0;
        $prof->text = 'Zoli';
        $prof->save();*/
        
// prof3

        $prof = new Prof();
        $prof->first_name = 'Ludovic';
        $prof->last_name = 'Lazar';
        $prof->nick_name = 'ludovic';
        $prof->email = 'ludovic@example.com';
        $prof->adresa = 'local';
        $prof->oras = 'local';
        $prof->scoala = 'local';
        $prof->activ = 1;
        $prof->blog = 1;
        $prof->text = 'Ludovic';
        $prof->save();
        
    }
}
