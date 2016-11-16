<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tournament;
use App\Player;
use App\Post;
use App\Prof;
use App\Tag;
use App\Category;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;

class TournamentController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = Auth::user();
    $prof_id = $user->prof_id;
    $prof = Prof::find($prof_id);
              // create a variable and store all the blog posts on the database
    if (Auth::check()){
      if ($user->prof_id == 1){  //superuser
       $tournaments = Tournament::orderBy('created_at', 'DESC')->paginate(7);
      }
      else if ($user->prof_id > 1) {
    $tournaments = Tournament::where('prof_id', '=', $prof_id)->orderBy('created_at', 'DESC')->paginate(7);
      /*$tournaments = DB::table('tournaments')
      ->join('users', 'users.id', '=', 'tournaments.user_id')
      ->join('profs', 'profs.id', '=', 'users.prof_id')
      ->select('tournaments.*')
      ->where('profs.id', '=', $prof_id)
      ->orderBy('tournaments.created_at', 'DESC')->paginate(7);*/
     }
  }else{
    $tournaments= Tournament::orderBy('posted_at', 'DESC')->paginate(7); 
  }
      return view('tournaments.index')->withTournaments($tournaments)->withUser($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      return view('tournaments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate the data
      $this->validate($request, array(
        'descriere'         => 'required|max:255',
        'posted_at'         => 'required|date|date_format:"Y-m-d"',
        'perioada'          => 'required',
        'slug'              => 'required|alpha_dash|min:3|max:20|unique:tournaments,slug',
        'nrrunde'           => 'required|integer|min:1|max:13',
        'localit'           => 'required|max:255',
        'tara'              => 'max:255',
        'stare'             => 'max:255',
        'obs'               => 'max:255',
        'chesssite'         => 'max:255'
        ));

        // Store in the database
      $tournament = new Tournament;

      $user = Auth::user();
      $prof_id = $user->prof_id;
      $prof = Prof::find($prof_id);

      $tournament->descriere = $request->descriere;
      $tournament->posted_at = $request->posted_at;
      $tournament->perioada = $request->perioada;
      $tournament->slug = $request->slug;
      $tournament->localit = $request->localit;
      $tournament->tara = $request->tara;
      $tournament->stare = $request->stare;
      $tournament->obs = $request->obs;
      $tournament->nrrunde = $request->nrrunde;
      $tournament->chesssite = $request->chesssite;
      $tournament->user_id = $user->id;
      $tournament->userid = $user->id;
      $tournament->prof_id = $prof_id;

      $tournament->prospect = ''; 
      $filename = '';
      $tournament->save();
      if ($request->file('prospect')){
        $file = $request->file('prospect');
        $filename = 'turneu'.$tournament->id.'.pdf';
        $tournament->prospect = $filename; 
        $tournament->update();      
      } 

      if ($filename){
        Storage::disk('local')->put('turnee'.'/'.$filename, File::get($file));
      }
      Session::flash('success', 'The Tournament was successfully saved!');

        // Redirect to another page
      return redirect()->route('tournaments.index', $tournament->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
      $tournament = Tournament::find($id);
      return view('tournaments.show')->with('tournament', $tournament)->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
        // Find the post in the database and save as a variable
      $tournament = Tournament::find($id);
        // Return the view and pass in the var
      return view('tournaments.edit')->with('tournament', $tournament)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $tournament = Tournament::find($id);
        // Validate the data
      if($request->input('slug') == $tournament->slug){
        $this->validate($request, array(
          'descriere'         => 'required|max:255',
          'posted_at'         => 'required|date|date_format:"Y-m-d"',
          'perioada'          => 'required',
          'nrrunde'           => 'required|integer|min:1|max:21',
          'localit'           => 'required|max:255',
          'tara'              => 'max:255',
          'stare'             => 'max:255',
          'obs'               => 'max:255',
          'chesssite'         => 'max:255'
          ));
      }else{
        $this->validate($request, array(
          'descriere'         => 'required|max:255',
          'posted_at'         => 'required|date|date_format:"Y-m-d"',
          'perioada'          => 'required',
          'slug'              => 'required|alpha_dash|min:3|max:20|unique:tournaments,slug',
          'nrrunde'           => 'required|integer|min:1|max:99',
          'localit'           => 'required|max:255',
          'tara'              => 'max:255',
          'stare'             => 'max:255',
          'obs'               => 'max:255',
          'chesssite'         => 'max:255'
          ));
      }

        // Save the data into the database
      $user = Auth::user();
      $prof_id = $user->prof_id;
      $prof = Prof::find($prof_id);

      $tournament->descriere = $request->descriere;
      $tournament->posted_at = $request->posted_at;
      $tournament->perioada = $request->perioada;
      $tournament->slug = $request->slug;
      $tournament->localit = $request->localit;
      $tournament->tara = $request->tara;
      $tournament->stare = $request->stare;
      $tournament->obs = $request->obs;
      $tournament->nrrunde = $request->nrrunde;
      $tournament->chesssite = $request->chesssite;
      $tournament->user_id = $user->id;
      $tournament->userid = $user->id;
      $tournament->prof_id = $prof_id;

      $filename = '';
      $tournament->update();
      if ($request->file('prospect')){
        $file = $request->file('prospect');
        $filename = 'turneu'.$tournament->id.'.pdf';
        $tournament->prospect = $filename; 
        $tournament->update();      
      } 
      if ($filename){
        Storage::disk('local')->put('turnee'.'/'.$filename, File::get($file));
      }
      Session::flash('success', 'This tournament was successfully saved.');
      return redirect()->route('tournaments.show', $tournament->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $tournament = Tournament::find($id);
      $tournament->delete();

      Session::flash('success', 'The tournament was successfully deleted.');

      return redirect()->route('tournaments.index');
    }

    public function getRound($id, $round)
    {

      return view('tournaments.round')->with('id', $id)->with('round', $round);
    }

    public function postRound(Request $request, $id, $round)
    {
      if ($request->file('prospect')){
        $file = $request->file('prospect');
        $filename = 'turneu'.$id.'-round'.$round.'.pdf';    
        Storage::disk('local')->put('turnee/runde'.'/'.$filename, File::get($file));
      } 
      return redirect()->route('tournaments.show', $id);

    }

    public function getInitial($id)
    {  
      return view('tournaments.initial')->with('id', $id);
    }

    public function postInitial(Request $request, $id)
    {
      if ($request->file('prospect')){
        $file = $request->file('prospect');
        $filename = 'turneu'.$id.'-initial'.'.pdf';    
        Storage::disk('local')->put('turnee/runde'.'/'.$filename, File::get($file));
      } 
      return redirect()->route('tournaments.show', $id);
    }

    public function getFinal($id)
    {  
      return view('tournaments.final')->with('id', $id);
    }

    public function postFinal(Request $request, $id)
    {
      if ($request->file('prospect')){
        $file = $request->file('prospect');
        $filename = 'turneu'.$id.'-final'.'.pdf';    
        Storage::disk('local')->put('turnee/runde'.'/'.$filename, File::get($file));
      } 
      return redirect()->route('tournaments.show', $id);
    }

    public function getElo($id)
    {  
      return view('tournaments.elo')->with('id', $id);
    }

    public function postElo(Request $request, $id)
    {
      if ($request->file('prospect')){
        $file = $request->file('prospect');
        $filename = 'turneu'.$id.'-elo'.'.pdf';    
        Storage::disk('local')->put('turnee/runde'.'/'.$filename, File::get($file));
      } 
      return redirect()->route('tournaments.show', $id);
    }


    public function getImages($id)
    {  
      return view('tournaments.photos')->with('id', $id);
    }

    public function postImages(Request $request, $id)
    {
      if ($request->file('foto')){
    /*    foreach (Input::file("foto") as $file) {
         $file = $request->file('foto');
         $filename = $id.'-foto'.'.jpg';    
         Storage::disk('local')->put('tournaments'.'/'.$id.'/'.$filename, File::get($file));*/
         $files = Input::file('foto');
    // Making counting of uploaded images
         $file_count = count($files);

         $uploadcount = 0;
         foreach($files as $file) {
      $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
      $validator = Validator::make(array('file'=> $file), $rules);
      if($validator->passes()){
        $destinationPath ='turnee/poze/'.$id;
        $filename = $file->getClientOriginalName();
        $upload_success = $file->move($destinationPath, $filename);
        $uploadcount ++;
      }
    }

  }      
  return redirect()->route('tournaments.show', $id);
}

public function destroyPlayer($id, $tournament)
{
  if ($id){
    $player = Player::find($id);
    $player->delete();
    Session::flash('success', 'The player was successfully deleted.');
  }

  $players = Player::where('tourid','=',$tournament)->orderBy('last_name', 'ASC')->paginate(9);
  $tournament = Tournament::find($tournament);
  return view('tournaments.registered')->with('players', $players)->with('tournament', $tournament);
}

}
