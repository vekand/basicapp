<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tournament;
use App\Age;
use App\Player;
use App\Prof;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
//use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;
//use Illuminate\Support\Facades\File;

class TournamentGuestController extends Controller
{
  public function index()
  {
 if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
    $tournaments= Tournament::orderBy('posted_at', 'DESC')->paginate(7); 


  return view('tournaments.index')->withTournaments($tournaments)->withUser($user);

}
public function chessResults($id)
{

 $tournament = Tournament::find($id);
 return view('frames.frame')->with('tournament', $tournament);
}

public function help()
{


  return view('help');
}

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


public function getFile($id)
{
  // pdf file

 $tournament = Tournament::find($id);
  if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
 try{
   $file = Storage::disk('local')->get('turnee'.'/'.'turneu'.$tournament->id.'.pdf');
   if ($file){
   return (new Response($file, 200))->header('Content-Type', $tournament->prospect);
 }
   
 } catch (\Exception $e) {
  if (Auth::check()){
   //$tournaments= Tournament::orderBy('posted_at', 'DESC')->paginate(7);
   //return view('tournaments.index')->withTournaments($tournaments)->withUser($user);;
    return redirect()->route('tournamentauth');
 }else{
  return redirect()->route('tournamentguest');
 }
}
}

public function getRound($id, $round)
{
  if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
  try{
   $file = Storage::disk('local')->get('turnee/runde'.'/turneu'.$id.'-round'.$round.'.pdf');
   return (new Response($file, 200))
   ->header('Content-Type', $id.'-'.$round.'.pdf');
 } catch (\Exception $e) {
  $tournament = Tournament::find($id);
  return view('tournaments.show')->with('tournament', $tournament)->with('user', $user);
}
}

public function getInitial($id)
{
  if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
  try{
   $file = Storage::disk('local')->get('turnee/runde/turneu'.$id.'-initial'.'.pdf');
   return (new Response($file, 200))
   ->header('Content-Type', $id.'-initial'.'.pdf');
 } catch (\Exception $e) {
   $tournament = Tournament::find($id);
   return view('tournaments.show')->with('tournament', $tournament)->with('user', $user);
 }
}

public function getFinal($id)
{
  if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
  try{
   $file = Storage::disk('local')->get('turnee/runde/turneu'.$id.'-final'.'.pdf');
   return (new Response($file, 200))
   ->header('Content-Type', $id.'-final'.'.pdf');
 } catch (\Exception $e) {
   $tournament = Tournament::find($id);
   return view('tournaments.show')->with('tournament', $tournament)->with('user', $user);
 }
}

public function getElo($id)
{
  if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
  try{
   $file = Storage::disk('local')->get('turnee/runde/turneu'.$id.'-elo'.'.pdf');
   return (new Response($file, 200))
   ->header('Content-Type', $id.'-elo'.'.pdf');
 } catch (\Exception $e) {
  $tournament = Tournament::find($id);
  return view('tournaments.show')->with('tournament', $tournament)->with('user', $user);
}
}

public function getRegister($id){
  // get the form player register
 $tournament = Tournament::find($id);
 $ages = Age::all();
 return view('tournaments.register')->with('tournament', $tournament)->with('ages', $ages);

}

public function postRegister(Request $request, $id){
     // Validate the data
  $this->validate($request, array(
    'first_name'         => 'required|max:255',
    'last_name'         => 'required|max:255',
    'category'          => 'required|max:255',
    'elo'              => 'required|max:20',
    'asociation'        => 'required|max:255',
    'city'           => 'required|max:255',
    'country'              => 'required|max:255',
    'email'             => 'required|email',
    'phone'               => 'max:255'
    ));

if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
        // Store in the database
  $player = new Player;

  $player->first_name = $request->first_name;
  $player->last_name = $request->last_name;
  $player->category = $request->category;
  $player->elo = $request->elo;
  $player->group = $request->group;
  $player->gender = $request->gender;
  $player->asociation = $request->asociation;
  $player->city = $request->city;
  $player->country = $request->country;
  $player->email = $request->email;
  $player->phone = $request->phone;
  $player->accomday = $request->accomday;
  $player->accomper = $request->accomper;
  $player->mess = $request->mess;
  $player->tourid = $id;

  if ($player->save()) {
    Session::flash('success', 'The Registration was successfully saved!');
  }


        // Redirect to another page
  return redirect()->route('tournamentguest');
  
}

public function getRegistered($id){
  // get the table show registered players
 $players = Player::where('tourid','=',$id)->orderBy('last_name', 'ASC')->paginate(9);
 $tournament = Tournament::find($id);
 return view('tournaments.registered')->with('players', $players)->with('tournament', $tournament);

}

public function getImages($id)
{
 $fol = [];
 $i=1;
 $j=1;
 $filesInFolder = \File::files(public_path().'/turnee/poze/'.$id);
 //$filesInFolder = Storage::disk('local')->get('/turnee/poze/'.$id);
 foreach($filesInFolder as $file)
 {
  $fol[] = basename($file);
}
if (Auth::check()){
    $user = Auth::user();
  }else{
    $user = [];
  }
if (count($fol) > 0){
 return view('tournaments.images')->with('files', $fol)->with('id', $id)->with('i', $i)->with('j', $j);
} else{
  $tournament = Tournament::find($id);
  return view('tournaments.show')->with('tournament', $tournament)->with('user', $user);
}
}








}
