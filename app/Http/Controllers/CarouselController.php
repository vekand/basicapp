<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Carousel;
use Session;

class CarouselController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function edit($id)
	{
		$carousel = Carousel::find($id);
		return view('carousel.edit')->with('carousel', $carousel);
	}	

	public function update(Request $request, $id)
	{
		$carousel = Carousel::find($id);
        // Validate the data
		$user = Auth::user();
		$this->validate($request, array(
			'title' =>'required|max:255',
			'body'   => 'required|max:255'
			));

		$carousel->title = $request->input('title');
		$carousel->body = $request->input('body');
		$carousel->readmore = $request->input('readmore');
		$carousel->userid = $user->id;
		$carousel->update();
		    
		$filename = '';
		$file=[];
		if ($request->file('img')){
			$file = $request->file('img');
			$filename = 'foto0'.$id.'.jpg';
			$carousel->img = $filename;  
			$carousel->update();     

			Storage::disk('img')->put($filename, File::get($file));
		} 
        Session::flash('success', 'This carousel was successfully saved.');

		return redirect()->route('carousel');
	}
	
}
