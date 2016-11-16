<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Course;
use App\User;
use App\Prof;
use App\Move;
use App\Diagram;
use App\Level;
use App\Pgn;
use App\Tipcourse;
use Session;
use Purifier;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
//use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
class CourseController extends Controller
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
      //$courses= Course::orderBy('id', 'DESC')->paginate(5);
     if ($user->prof_id == 1){
       $courses= Course::orderBy('created_at', 'DESC')->paginate(5);
     }
     else if ($user->prof_id > 1){

      //$courses= Course::where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->paginate(5);
      $courses= Course::where('prof_id', '=', $prof_id)->orderBy('created_at', 'DESC')->paginate(5);

      /* $courses = Course::join('users', 'users.id', '=', 'courses.user_id')
       ->join('profs', 'profs.id', '=', 'users.prof_id')
       ->where('profs.id', '=', $prof_id)
       ->orderBy('courses.created_at', 'DESC')->paginate(5);*/

       /*$courses = Course::join('users', 'courses.user_id', '=', 'users.id')
       ->where('users.prof_id', '=', $prof_id)
       ->orderBy('courses.created_at', 'DESC')->paginate(5);*/
     }
//var_export($courses);
     return view('courses.index')->withCourses($courses)->withUser($user);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $levels = Level::all();
      $tipcourses = Tipcourse::all();
      return view('courses.create')->withLevels($levels)->withTipcourses($tipcourses);    
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
        'tipcurs'         => 'required|max:255',
        'datacurs'        => 'required|date|date_format:"Y-m-d"',
        'slug'            => 'required|alpha_dash|min:3|max:20|unique:courses,slug'

        ));

      $user = Auth::user();
      $prof_id = $user->prof_id;
      $prof = Prof::find($prof_id);
      $course = new Course;

      $course->tipcurs = $request->tipcurs;
      $course->datacurs = $request->datacurs;
      $course->slug = $request->slug;
      $course->starecurs = $request->starecurs;
      $course->obscurs = $request->obscurs;
      $course->level_id = $request->level;
      $course->tipcourse_id = $request->tipcourse;
      $course->user_id = $user->id;
      $course->userid = $user->id;
      $course->prof_id = $prof_id;
      //$course->gameeditor = 'https://www.chess.com';
      $course->gameeditor = '';
      $course->playcomp = '';

      $course->fiscurs = ''; 
      $filename = '';
      $course->save();
      if ($request->file('fiscurs')){
        $file = $request->file('fiscurs');
        $filename = 'course'.$course->id.'.pdf';
        $course->fiscurs = $filename; 
        $course->update();      
      } 
      if ($filename){
        Storage::disk('local')->put('cursuri'.'/'.$filename, File::get($file));
      }

      Session::flash('success', 'The Course was successfully saved!');
      return redirect()->route('courses.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $course = Course::find($id);
      return view('courses.show')->with('course', $course);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         // Find the post in the database and save as a variable
      $course = Course::find($id);

      $levels = Level::all();
      $levels2 = [];

      foreach($levels as $level) {
        $levels2[$level->id] = $level->name;
      }

      $tipcourses = Tipcourse::all();
      $tipcourses2= array();
      foreach($tipcourses as $tipcourse) {
        $tipcourses2[$tipcourse->id] = $tipcourse->name;
      }

      return view('courses.edit')->withCourse($course)->withLevels($levels2)->withTipcourses($tipcourses2);
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
      $course = Course::find($id);
        // Validate the data
      if($request->input('slug') == $course->slug){
        $this->validate($request, array(
          'tipcurs'         => 'required|max:255',
          'datacurs'         => 'required|date|date_format:"Y-m-d"',

          ));
      }else{
        $this->validate($request, array(
          'tipcurs'         => 'required|max:255',
          'datacurs'         => 'required|date|date_format:"Y-m-d"',
          'slug'              => 'required|alpha_dash|min:3|max:20|unique:courses,slug',

          ));
      }

      $user = Auth::user();
      $prof_id = $user->prof_id;
      $prof = Prof::find($prof_id);

      $course->tipcurs = $request->tipcurs;
      $course->datacurs = $request->datacurs;
      $course->slug = $request->slug;
      $course->starecurs = $request->starecurs;
      $course->obscurs = $request->obscurs;
      $course->level_id = $request->level;
      $course->tipcourse_id = $request->tipcourse;
      $course->user_id = $user->id;
      $course->userid = $user->id;
      $course->prof_id = $prof_id;

      $filename = '';
      $course->update();
      if ($request->file('fiscurs')){
        $file = $request->file('fiscurs');
        $filename = 'course'.$course->id.'.pdf';
        $course->fiscurs = $filename; 
        $course->update();      
      } 
      if ($filename){
        Storage::disk('local')->put('cursuri'.'/'.$filename, File::get($file));
      }

      Session::flash('success', 'The Course was successfully saved!');

      return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $course = Course::find($id);
      $course->users()->detach();
      $course->delete();

      Session::flash('success', 'The course was successfully deleted.');

      return redirect()->route('courses.index');
    }

    public function access($id)
    {
     $course = Course::find($id);
     
     $user = Auth::user();
     //$users = User::where('activ','=',1)->get();
     if ($user->prof_id == 1){
       $users = User::where('activ','=',1)->orderBy('last_name', 'ASC')->get();
     }
     else if ($user->prof_id > 1){
      $users = User::where('prof_id', '=', $user->prof_id)->where('activ','=',1)->orderBy('last_name', 'ASC')->get();
    }
    return view('courses.access')->withCourse($course)->withUsers($users);
  }

  public function assignAccess(Request $request, $id)
  {

    $course = Course::find($id);
   // $users = User::all();

    $user = Auth::user();
    if ($user->prof_id == 1){
      $users = User::all();
    }
    else if ($user->prof_id > 1){
      $users = User::where('prof_id', '=', $user->prof_id)->get();
    }

    $course->users()->newPivotStatement()->where('course_id', $course->id)->delete();
    //$count =$users->count();
    if ($request['check']){
      foreach ($request['check'] as $cec){

       if ($cec>0)
        $course->users()->attach($cec);
    }
  }
  return redirect()->route('courses.index');  
}

public function getDiagrams($id)
{

 $course = Course::find($id);
 $diagrams = Diagram::where('course_id', $course->id)->where('acasa', 1)->get();
 $user = Auth::user();
 $moves = [];
 return view('courses.diagrame')->withCourse($course)->withDiagrams($diagrams)->withUser($user)->withMoves($moves);
}

public function newDiagram($id)
{
 $course = Course::find($id);
 $diagrams = Diagram::where('course_id', $course->id)->where('acasa', 1)->get();
 $user = Auth::user();
 $moves = [];
       //var_export($user);
 return view('courses.diagrame')->withCourse($course)->withDiagrams($diagrams)->withUser($user)->withMoves($moves);
}

public function homework($id)
{
 $course = Course::find($id);
 $diagrams = Diagram::where('course_id', $course->id)->where('acasa', 1)->get();
 $moves = [];
 $user = Auth::user();
       //var_export($user);
 return view('courses.diagrame')->withCourse($course)->withDiagrams($diagrams)->withUser($user)->withMoves($moves);
}
public function homeworkall($id)
{
 $course = Course::find($id);
 $diagrams = Diagram::where('course_id', $course->id)->get();
 $moves = [];
 $user = Auth::user();
       //var_export($user);
 return view('courses.diagrame')->withCourse($course)->withDiagrams($diagrams)->withUser($user)->withMoves($moves);
}
public function solved($id)
{
 $course = Course::find($id);
 $diagrams = Diagram::where('course_id', $course->id)->where('acasa', 1)->get();
 $user = Auth::user();
 $moves = [];
       //var_export($user);
 return view('courses.diagrame')->withCourse($course)->withDiagrams($diagrams)->withUser($user)->withMoves($moves);
}

public function editor($id)
{

  $course = Course::find($id);
  $user = Auth::user();
  $tml = '';
  try{
    $file = Storage::disk('local')->get('cursuri'.'/html'.$id.'.html'); 
    $tml = $file;
    return view('courses.editor')->withCourse($course)->withUser($user)->withTml($tml);
  } catch (\Exception $e) {
    $tml = '';
    return view('courses.editor')->withCourse($course)->withUser($user)->withTml($tml);
  }
}

public function saveHTML(Request $request, $id)
{
  $course = Course::find($id);
  $user = Auth::user();
  $content = $request['content'];
  $filename = 'html'.$course->id.'.html';
  Storage::disk('local')->put('cursuri/'.$filename, $content);

  return view('courses.output', ['content' => $content, 'course' => $course->id]);

}


public function postMoves(Request $request, $id)
{
// save moves to DB

  //$mutari = count($request['mutari']);
  $user = Auth::user();
  $prof_id = $user->prof_id;
  $prof = Prof::find($prof_id);

  $course = Course::find($id);
  $diagram = new Diagram;
  $diagram->course_id = $course->id;
  //$diagram->feninitial = $request['mutari'][0];
  //$diagram->fenfinal = $request['mutari'][$mutari];
  $diagram->explicatii = $request['explicatie'];
  $diagram->prof_id = $prof_id;
  if($request['ceccasa']) {$diagram->acasa = 1;}
  else {$diagram->acasa = 0;}
  $diagram->userid = $user->id;
  $diagram->body = $request['varimut'];

  
  $i=1;
  $m=1;
  if(isset($request['movuri'])){
    $movuri = explode(',', $request['movuri']);
    $j = count($movuri);
    $albul = $request['albul'];
    $pgn = $request['pgnuri'];
    $steag = 0;
    foreach ($movuri as $mutari){
      $mutare = explode('?_?', $mutari);
      $muta0=$mutare[0];
      $muta1=$mutare[1];
      //////////////////////////////////
      if ($i==1 && $albul=="1"){
        $diagram->feninitial = $mutare[1];
        $diagram->alb = 1;
        $diagram->save();
      }
      elseif ($i==1 && $albul=="0"){
        $diagram->feninitial = $mutare[1];
        $diagram->alb = 1;
        $diagram->save();
      }
      if ($i==$j && $albul=="1"){
        $diagram->fenfinal = $mutare[1];
        $diagram->alb = 1;
        $diagram->update();
      }
      elseif ($i==$j && $albul=="0"){
        $diagram->fenfinal = $mutare[1];
        $diagram->alb = 0;
        $diagram->update();
      }
//////////////////////////////////////////////////

      if ($steag == 0) {
        $move = new Move;
        $move->mutare = $m;
        $move->userid = $user->id;
      }
      $move->diagram_id = $diagram->id;
      $move->alb = $albul;
      $move->mutarepgn = $pgn;


      if ($i==2 && $albul=="0"){
        $move->mutarefena = '';
        $move->mutarefenn = $muta1;
        $move->save();
        $steag = 0;
        $m++;
      }
      elseif ($i==2 && $albul=="1"){
        $move->mutarefena = $muta1;
        $move->mutarefenn = '';
        $move->save();
        $steag = 1;
      }
      if ($i>2){
        if ($muta0 == 'White' || $muta0 == 'Alb'){
          $move->mutarefena = $muta1;
          if ($steag == 0) {

            $move->save();
            $steag = 1;
          }
          elseif ($steag == 1) {
            $move->update();
            $steag = 0;
            $m++;
          }      
        }
        if ($muta0 == 'Black' || $muta0 == 'Negru'){
          $move->mutarefenn = $muta1;
          if ($steag == 0) {
            $move->save();
            $steag = 1;
          }
          elseif ($steag == 1) {
            $move->update();
            $steag = 0;
            $m++;
          }      
        }

      }

      $i++;
    }

} // endif

//$courses= Course::orderBy('created_at', 'DESC')->paginate(5);

// save to pgn
if(isset($request['cec'])){
  $pgn = new Pgn;
  $pgn->eventu = $course->tipcurs;
  $pgn->siteu = $request['explicatie'];
  $pgn->roundu = '';
  $pgn->whiteu = 'White: '.$user->last_name.' '.$user->first_name;
  $pgn->blacku = 'Black: '.$user->last_name.' '.$user->first_name;
  $pgn->resultu = '';
  $pgn->whiteelo = '';
  $pgn->blackelo = '';  
  $pgn->plycount = '';
  $pgn->dateu = 'Date: '.$course->datacurs;;
  $pgn->adnotator = '';
  $pgn->eventdate = '';
  $pgn->eventtype = '';
  $pgn->evcountry = ''; 
  $pgn->eco = ''; 
  $pgn->body = $request['pgnuri'];
  $pgn->comment = $request['varimut'];
  $pgn->course_id = $course->id;
  $pgn->diagram_id = $diagram->id;
  $pgn->feninitial = $diagram->feninitial;
  $pgn->save();
}



$user = Auth::user();
$prof_id = $user->prof_id;
$prof = Prof::find($prof_id);
      //$courses= Course::orderBy('id', 'DESC')->paginate(5);
if ($user->prof_id == 1){
 $courses= Course::orderBy('created_at', 'DESC')->paginate(5);
}
else if ($user->prof_id > 1){
      //$courses= Course::where('user_id', '=', $user->id)->orderBy('created_at', 'DESC')->paginate(5);
  $courses= Course::where('prof_id', '=', $prof_id)->orderBy('created_at', 'DESC')->paginate(5);
}

return view('courses.index')->withCourses($courses)->withUser($user);
}

public function getDiagramHomework($id)
{
  $diagram = Diagram::find($id);
  $course_id = $diagram->course->id;
  $course = Course::find($course_id);
  $diagrams = Diagram::where('course_id', '=', $course->id)->get();
  $moves = Move::where('diagram_id', '=', $diagram->id)->get();
  $user = Auth::user();
  return response()->json(['mutaritema' => $moves], 200);
}

public function gethWork(Request $request)
{
  $id = $request['id'];
  $diagram = Diagram::find($id);
  $moves = Move::where('diagram_id', '=', $diagram->id)->get();
  return response()->json(['mutaritema'=> $moves, 'explic'=> $diagram->explicatii, 'body'=> $diagram->body,'feninitial'=> $diagram->feninitial, 'fenfinal'=> $diagram->fenfinal], 200);
//return Response::json($moves);
}

public function solveDiagram(Request $request)
{
  $iddiagram = $request['iddiagram'];
  if ($request['iddiagram']) $clickuri = $request['clickuri'];
  else $clickuri = 0;
  $diagram = Diagram::find($iddiagram);
  $diagram_id = $diagram->id;
  $user = Auth::user();
  $user_id = $user->id;
  $diagram->users()->detach($user_id);

  /*$projects = array_fill_keys($user_id, [
        'clickuri' => $clickuri
    ]);*/
  //$diagram->users()->attach($user_id);
  $diagram->users()->attach([$user_id => ['clickuri' => $clickuri]]);

  /*$iddiagram = $request['iddiagram'];
  $user = Auth::user();
  $user_id = $user->id;
  $user->diagrams()->detach();
  $user->diagrams()->attach($user_id);*/

  $diagram = Diagram::find($iddiagram);
  $course_id = $diagram->course->id;
  $course = Course::find($course_id);
  $diagrams = Diagram::where('course_id', '=', $course->id)->where('acasa', '=', 1)->get();
  

  
  
  $moves = [];
       //var_export($user);
  return view('courses.diagrame')->withCourse($course)->withDiagrams($diagrams)->withUser($user)->withMoves($moves);
}

public function getSolvedDiagrams($id)
{

 $course = Course::find($id);
 $user = Auth::user();
 //$diagram = Diagram::where('course_id', '=', $course->id)->get();
 //$diagrams = Diagram::where('course_id', '=', $course->id)->paginate(7);
 $diagrams = DB::table('user_diagram')
 ->join('diagrams', 'diagrams.id', '=', 'user_diagram.diagram_id')
 ->join('courses', 'courses.id', '=', 'diagrams.course_id')
 ->join('users', 'users.id', '=', 'user_diagram.user_id')
 ->select('user_diagram.*', 'diagrams.id as diagr_id', 'diagrams.explicatii', 'diagrams.created_at as create_at',
  'courses.id as cour_id', 'users.last_name', 'users.first_name')
 ->where('courses.id', '=', $course->id)
 ->orderBy('diagr_id')->paginate(11);

 //$diagrams = Diagram::where('course_id', '=', $course->id)->paginate(5);

 return view('courses.solved')->withCourse($course)->withDiagrams($diagrams)->withUser($user);
}

/*public function savePgn(Request $request)
{
  // save pgn to local 

  $dia = $request['dia'];
  $curs = $request['curs'];
  $flag = $request['flag'];
  $iddiagram = $request['iddiagram'];
  $dia = str_replace('data:image/png;base64,', '', $dia);
  $dia = str_replace(' ', '+', $dia);
  $data = base64_decode($dia);
  $folder =  'C:/png';
//file_put_contents('http://localhost/basicapp/public/png/image.png', $data);
  $fisier = 'C:/png/c'.$curs.'d'.$iddiagram.'p'.$flag.'.png';
  if (file_exists($folder))
    file_put_contents($fisier, $data);
  else
    return Response::json(['error' => 'Error msg'], 404); 
}*/

public function savePgn(Request $request)
{
  // save pgn to local 

  $dia = $request['dia'];
  $curs = $request['curs'];
  $flag = $request['flag'];
  $iddiagram = $request['iddiagram'];
  $dia = str_replace('data:image/png;base64,', '', $dia);
  $dia = str_replace(' ', '+', $dia);
  $data = base64_decode($dia);
  $folder =  'C:/png';
//file_put_contents('http://localhost/basicapp/public/png/image.png', $data);
  $fisier = 'C:/png/c'.$curs.'d'.$iddiagram.'p'.$flag.'.png';
  if (file_exists($folder))
    file_put_contents($fisier, $data);
  else
    return Response::json(['error' => 'Error msg'], 404); 
} 

/*public function savePgn(Request $request)
{
  // save pgn to local 

  $dia = $request['dia'];
  $curs = $request['curs'];
  $flag = $request['flag'];
  $iddiagram = $request['iddiagram'];
  $dia = str_replace('data:image/png;base64,', '', $dia);
  $dia = str_replace(' ', '+', $dia);
  $data = base64_decode($dia);
  $folder =  'C:/png';
//file_put_contents('http://localhost/basicapp/public/png/image.png', $data);
  $fisier = 'c'.$curs.'d'.$iddiagram.'p'.$flag.'.png';
  //if (file_exists($folder))
    Storage::disk('local')->put('cursuri/'.$fisier, $data);
    //return response()->download($folder, $fisier);
    //return Response::json(['error' => 'Error msg'], 404);
}*/

public function getFilePDF($id)
{
  //view pdf by the students
 $course = Course::find($id);
 try{
   $file = Storage::disk('local')->get('cursuri'.'/'.'course'.$course->id.'.pdf');
   return (new Response($file, 200))->header('Content-Type', $course->fiscurs);

 } catch (\Exception $e) {
   $courses= Course::orderBy('created_at', 'DESC')->paginate(7);
   return redirect()->route('courses.index');
 }
}

public function getFileHTML($id)
{
  //view html by the students

  $course = Course::find($id);
  $tml = '';
  try{
    $file = Storage::disk('local')->get('/cursuri'.'/html'.$id.'.html'); 
    $content = $file;
    return view('courses.output', ['content' => $content, 'course' => $course->id]);
  } catch (\Exception $e) {
   return redirect()->route('courses.index');
 }

}

public function gameEditor($id)
{

 $course = Course::find($id);
 return view('courses.frame')->with('course', $course);
}
public function gamePlay($id)
{

 $course = Course::find($id);
 return view('courses.frame2')->with('course', $course);
}

public function pgnViewer($id)
{
  $course = Course::find($id);
  $pgns = Pgn::where('course_id', $id)->get();
  if ($pgns) $pegeneu =Pgn::find(1);
  return view('pgnviewer.viewpgn')->with('pgns', $pgns)->with('pegeneu', $pegeneu)->with('course', $course);
}

public function pgnEdit($id)
{
  $course = Course::find($id);
  return view('pgnviewer.editpgn')->with('course', $course);
}
public function pgnEditor($id)
{
  $course = Course::find($id);
  return view('pgnviewer.pgneditor_input')->with('course', $course);
}
public function pgnRetrieve(Request $request, $id)
{
  // view all pgn files in combo

  $course = Course::find($id);
  if ($request['pegene']){
    $id = $request['pegene']; 
  }

    $pgns = Pgn::all();
  
  $pegeneu = Pgn::find($id);
  //echo $pegeneu->body;
  return view('pgnviewer.viewpgn')->with('pgns', $pgns)->with('pegeneu', $pegeneu)->with('course', $course);

}

public function numaicurs(Request $request, $id)
{
  $course = Course::find($id);

    $pgns = Pgn::all(); 
  
  $pegeneu = Pgn::find($id);
  //echo $pegeneu->body;
  return view('pgnviewer.viewpgn')->with('pgns', $pgns)->with('pegeneu', $pegeneu)->with('course', $course);

}

public function pgnPost(Request $request, $id)
{

   // Validate the data
  $this->validate($request, array(
    'pgnfile'         => 'required'
    ));
  $course = Course::find($id);
  $file = $request->file('pgnfile');
  $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $nri = count($lines); 
  $nr_match = 0;  //current match
  $this_match = 1;  //to know is other match
  $j = 0;
  $k = 0;

  for($i=0; $i<$nri; $i++){ 
    if (stripos($lines[$i], '[Event') === 0) { 
      if ($nr_match == $this_match){
        $pgn->save();
        $filename = 'pgn'.$pgn->id.'.pgn';
        $pgn->fisier = $filename;
        $pgn->course_id = $id;  
        $pgn->update();
        $nr_match--; 
        $j = 0;   
      }
    $nr_match++; 
    $pgn = new Pgn;
    $j = 1;
    } 

if($nr_match == $this_match){  
  if (preg_match('/\[([^\]]*)\]/i', $lines[$i], $match)) {
    $x = $match[1]; 

    if (strpos($x, 'Event') === 0) $pgn->eventu = $x;
    else if (strpos($x, 'Site') === 0) $pgn->siteu = $x;
    else if (strpos($x, 'Round') === 0) $pgn->roundu = $x;
    else if (strpos($x, 'White') === 0) $pgn->whiteu = $x;
    else if (strpos($x, 'Black') === 0) $pgn->blacku = $x;
    else if (strpos($x, 'Result') === 0) $pgn->resultu = $x;
    else if (strpos($x, 'WhiteElo') === 0) $pgn->whiteelo = $x;
    else if (strpos($x, 'BlackElo') === 0) $pgn->blackelo = $x;  
    else if (strpos($x, 'PlyCount') === 0) $pgn->plycount = $x;
    else if (strpos($x, 'Date') === 0) $pgn->dateu = $x;
    else if (strpos($x, 'Annotator') === 0) $pgn->adnotator = $x;
    else if (strpos($x, 'EventDate') === 0) $pgn->eventdate = $x;
    else if (strpos($x, 'EventType') === 0) $pgn->eventtype = $x;
    else if (strpos($x, 'EventCountry') === 0) $pgn->evcountry = $x; 
    else if (strpos($x, 'ECO') === 0) $pgn->eco = $x; 
  }else {
    $pgn->body .= $lines[$i];
  }

} 
  
}  // end for

 if ($j == 1){
        $pgn->save();
        $filename = 'pgn'.$pgn->id.'.pgn';
        $pgn->fisier = $filename; 
        $pgn->course_id = $id;
        $pgn->update();    
      }
  Session::flash('success', 'The PGN file was successfully loaded!');
  $pegeneu = $pgn;
  $pgns = Pgn::all();
  return view('pgnviewer.viewpgn')->with('pgns', $pgns)->with('pegeneu', $pegeneu)->with('course', $course);

}



}