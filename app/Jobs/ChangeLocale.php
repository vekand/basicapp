<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;

class ChangeLocale extends Job implements SelfHandling
{
    protected $lang;

    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    public function handle()
    {
        session()->put('locale',$this->lang);
    }
}