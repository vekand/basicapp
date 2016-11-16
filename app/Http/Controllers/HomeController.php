<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\ChangeLocale;

class HomeController extends Controller
{

    public function language(Request $request)
    {
        $changeLocale = new ChangeLocale($request->lang);
        $this->dispatch($changeLocale);

        return redirect()->back();
    }
}