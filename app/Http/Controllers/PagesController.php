<?php

namespace App\Http\Controllers;

use App\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Carousel;
use App\About;
use App\Home;
use Mail;
use Session;
use App;
use DB;
use Purifier;
use App\Prof;
/**
* 
*/
class PagesController extends Controller
{
	
	public function getIndex()
	{
		if (Auth::check()){
			$user = Auth::user();
		}else{
			$user = [];
		}
		
		$home = Home::find(1);

		return view('pages.welcome')->withHome($home)->withUser($user);
	}
	public function getCarousel()
	{
		$carousels = Carousel::all();
		return view('carousel.carousel')->withCarousels($carousels);
	}	
	public function getAbout($id)
	{
		// id = id prof
		if (Auth::check()){
			$user = Auth::user();
		}else{
			$user = [];
		}

		$prof = Prof::find($id);    
		$about = About::where('prof_id', '=', $id)->first();
		return view('pages.about')->withAbout($about)->withProf($prof)->withUser($user);
	}

	public function getContact()
	{
		return view('pages.contact');
	}

	public function postContact(Request $request)
	{
		$this->validate($request, array(
			'email'         => 'required|email',
			'subject'       => 'required|alpha_dash|min:5|max:255',
			'message'       => 'required'
			));
		$data = array(
			'email' =>  $request->email,
			'subject' =>  $request->subject,
			'bodyMessage' =>  $request->message,
			'survey' => ['01' => 'hello', '02' => 'salut']
			);
		Mail::send('emails.contact', $data, function ($message) use ($data){
			$message->from($data['email']);
			// $message->sender($data['email']);

			$message->to('andreivek246@gmail.com', 'andrei');

			/*	$message->cc('john@johndoe.com', 'John Doe');
			$message->bcc('john@johndoe.com', 'John Doe');

			$message->replyTo('john@johndoe.com', 'John Doe');
			*/
			$message->subject($data['subject']);

			$message->priority(3);

			/*$message->attach('pathToFile');*/
		});

		  // set flash data with success message
		Session::flash('success', 'The mail was successfully sent.');

        // Redirect with flash data to posts.show
		return redirect()->route('home');
	}

/*	public function getLocale($locale) {
    	App::setLocale($locale);
    	$posts = Post::orderBy('created_at', 'DESC')->limit(4)->get();
		return view('pages.welcome')->withPosts($posts);
	}*/


	public function getFoto($filename){
    /*    $file = Storage::disk('img')->get($filename);
        //return new Response($file);
    return Storage::get($filename);*/
    $path = storage_path().'/img/'.$filename;
    if (file_exists($path)) {
    	return Response::download($path);
    }
}

public function editAbout($id)
{
	
	$about = About::find($id);
	$profid = $about->prof_id;
	$prof = Prof::find($profid);    
	return view('pages.editabout')->withAbout($about)->withProfid($profid);
}

public function updateAbout(Request $request, $id)
{
	$this->validate($request, array(
		'title'         => 'required|max:255',
		'body'       => 'required',
		));
	$profid = $request['profid'];
	$about = About::find($id);
	$about->title = $request['title'];
	$about->body = Purifier::clean($request->input('body'));
	$about->prof_id = $profid;
	$about->update();
	$i=0;
	$filename = '';
	$file=[];
	if ($request->file('foto1')){
		$file = $request->file('foto1');
		$i=1;
		$filename = 'foto1'.$i.'.jpg';
		$about->foto1 = $filename;  
		$about->update();     
		Storage::disk('img')->put('/'.$profid.'/'.$filename, File::get($file));
	} 
	if ($request->file('foto2')){
		$file = $request->file('foto2');
		$i=2;
		$filename = 'foto1'.$i.'.jpg';
		$about->foto2 = $filename;  
		$about->update();     
		Storage::disk('img')->put('/'.$profid.'/'.$filename, File::get($file));
	} 
	if ($request->file('foto3')){
		$file = $request->file('foto3');
		$i=3;
		$filename = 'foto1'.$i.'.jpg';
		$about->foto3 = $filename;  
		$about->update();     
		Storage::disk('img')->put('/'.$profid.'/'.$filename, File::get($file));
	}
	if ($request->file('foto4')){
		$file = $request->file('foto4');
		$i=4;
		$filename = 'foto1'.$i.'.jpg';
		$about->foto4 = $filename;  
		$about->update();     
		Storage::disk('img')->put('/'.$profid.'/'.$filename, File::get($file));
	}
	if ($request->file('foto5')){
		$file = $request->file('foto5');
		$i=5;
		$filename = 'foto1'.$i.'.jpg';
		$about->foto5 = $filename;  
		$about->update();     
		Storage::disk('img')->put('/'.$profid.'/'.$filename, File::get($file));
	}   
	Session::flash('success', 'The About was successfully updated!');
	return redirect()->route('about', $profid);
}

public function editHome($id)
{
	$home = Home::find($id);

	return view('pages.edithome')->withHome($home);
}

public function updateHome(Request $request, $id)
{
	$this->validate($request, array(
		'title'         => 'required|max:255',
		'body'       => 'required',
		'site1'       => 'url',
		'site2'       => 'url',
		'site3'       => 'url'
		));
	$home = Home::find($id);
	$home->title = $request['title'];
	$home->site1 = $request['site1'];
	$home->site2 = $request['site2'];
	$home->site3 = $request['site3'];
	$home->body = Purifier::clean($request->input('body'));
	if ($request['delfoto']){		
		Storage::disk('home')->delete($home->foto1);
		$home->foto1 = ''; 
	}
	if ($request->file('foto1')){
		$file = $request->file('foto1');
		$filename = 'home'.$home->id.'.'.$file->getClientOriginalExtension();
        //$filename = 'post'.$post->id.'.'.$file->encode('png'); // trensform to PNG file
        //$locattion = storage_path('app/posts/').$filename; // direct path
        //$locattion = asset('app/posts').$filename; // url
        //Image::make($file)->resize(400 , 300)->save($locattion);
		
		$home->foto1 = $filename; 
		$home->update();   
		if ($filename){
			Storage::disk('home')->put($filename, File::get($file));
		}   
	} 
if ($request->file('logo1')){
		$file = $request->file('logo1');
		$filename = 'logo1.'.$file->getClientOriginalExtension();
		$home->logo1 = $filename; 
		$home->update();   
		if ($filename){
			Storage::disk('img')->put('sponsor'.'/'.$filename, File::get($file));
		}   
	} 
if ($request->file('logo2')){
		$file = $request->file('logo2');
		$filename = 'logo2.'.$file->getClientOriginalExtension();
		$home->logo2 = $filename; 
		$home->update();   
		if ($filename){
			Storage::disk('img')->put('sponsor'.'/'.$filename, File::get($file));
		}   
	} 
if ($request->file('logo3')){
		$file = $request->file('logo3');
		$filename = 'logo3.'.$file->getClientOriginalExtension();
		$home->logo3 = $filename; 
		$home->update();   
		if ($filename){
			Storage::disk('img')->put('sponsor'.'/'.$filename, File::get($file));
		}   
	} 
	$home->update();
	return redirect()->route('home');
}


}