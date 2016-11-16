<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Request;

class setLocale extends Job implements SelfHandling
{

    protected $languages;

    public function __construct()
    {
        $this->languages = config('app.languages');
    }

    public function handle()
    {
        if(!session()->has('locale'))
        {
            session()->put('locale', \Request::getPreferredLanguage($this->languages));
        }

        app()->setLocale(session('locale'));
    }
}