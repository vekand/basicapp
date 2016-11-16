<?php

namespace App\Http\Controllers;
use App\User;
use App\Role;
use App\Prof;
use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
 public function __construct() {
  $this->middleware('auth');
}

   /* public function getIndex()
    {
        return view('index');
      }*/

 /*   public function getAuthorPage()
    {
        return view('author');
      }*/

      public function getAdminPage()
      {
        $user = Auth::user();
        $profs = Prof::all();
        $search = '';
        if ($user->prof_id == 1){
          $users = User::orderBy('created_at', 'DESC')->paginate(10);
        }
        else if ($user->prof_id > 1){
          $users = User::where('prof_id', '=', $user->prof_id)->orderBy('created_at', 'DESC')->paginate(10);
        }
        $paginate = true;
        return view('admin', ['users' => $users, 'profs' => $profs, 'search'  => $search, 'paginate' => $paginate]);
      }

      public function getAdminPageFilter(Request $request)
      {
        $search = $request->input('search');
        $user = Auth::user();
        $profs = Prof::all();
        if ($user->prof_id == 1){
          $users = User::Where('last_name', 'like', '%'.$search.'%')->orderBy('created_at', 'DESC')->paginate(10);
        }
        else if ($user->prof_id > 1){
         $users = User::where('prof_id', '=', $user->prof_id)->Where('last_name', 'like', '%'.$search.'%')->orderBy('created_at', 'DESC')->paginate(10);

       }
       $paginate = true;
       return view('admin', ['users' => $users, 'profs' => $profs, 'search'  => $search, 'paginate' => $paginate]);
     }

     public function postAdminAssignRoles(Request $request)
     {
      $user = User::where('email', $request['email'])->first();
      $user->roles()->detach();
      if ($request['activ']) {
        $user->activ=1;
      } else {
        $user->activ=0;
      }
      if ($request['profesor']){
        $user->prof_id = $request['profesor'];
      }
      $user->save();
      if ($request['role_visitor']) {
        $user->roles()->attach(Role::where('name', 'Visitor')->first());
      }
      if ($request['role_blogger']) {
        $user->roles()->attach(Role::where('name', 'Blogger')->first());
      }
      if ($request['role_referee']) {
        $user->roles()->attach(Role::where('name', 'Referee')->first());
      }
      if ($request['role_teacher']) {
        $user->roles()->attach(Role::where('name', 'Teacher')->first());
      }
      if ($request['role_student']) {
        $user->roles()->attach(Role::where('name', 'Student')->first());
      }
      if ($request['role_author']) {
        $user->roles()->attach(Role::where('name', 'Author')->first());
      }
      if ($request['role_admin']) {
        $user->roles()->attach(Role::where('name', 'Admin')->first());
      }
      if ($request['role_super']) {
        $user->roles()->attach(Role::where('name', 'Super')->first());
      }
      return redirect()->back();
    }


    public function getProfPage()
    {
      $user = Auth::user();
      $profs = Prof::paginate(7);

      return view('profesori.profesori', ['profs' => $profs]);
    }

    public function postProfPage(Request $request)
    {
      $user = User::where('email', $request['email'])->first();
      $user = Auth::user();
      $user->roles()->detach();
      if ($request['activ']) {
        $user->activ=1;
      } else {
        $user->activ=0;
      }
      $user->save();
      if ($request['role_visitor']) {
        $user->roles()->attach(Role::where('name', 'Visitor')->first());
      }
      if ($request['role_blogger']) {
        $user->roles()->attach(Role::where('name', 'Blogger')->first());
      }
      if ($request['role_referee']) {
        $user->roles()->attach(Role::where('name', 'Referee')->first());
      }
      if ($request['role_teacher']) {
        $user->roles()->attach(Role::where('name', 'Teacher')->first());
      }
      if ($request['role_student']) {
        $user->roles()->attach(Role::where('name', 'Student')->first());
      }
      if ($request['role_author']) {
        $user->roles()->attach(Role::where('name', 'Author')->first());
      }
      if ($request['role_admin']) {
        $user->roles()->attach(Role::where('name', 'Admin')->first());
      }
      if ($request['role_super']) {
        $user->roles()->attach(Role::where('name', 'Super')->first());
      }
      return redirect()->back();
    }

    public function createProf()
    {     
      return view('profesori.create');    
    }

    public function editProf($id)
    {     
      $prof =Prof::find($id);
      return view('profesori.edit')->withProf($prof);    
    }

    public function storeProf(Request $request)
    {   
      $user = Auth::user();
      $prof = new Prof;

             // Validate the data
      $this->validate($request, array(
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'nick_name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:profs',
        'activ' => 'required|integer|min:0|max:1',
        'blog' => 'required|integer|min:0|max:1'
        ));
      

      $prof->first_name = $request->first_name;
      $prof->last_name = $request->last_name;
      $prof->nick_name = $request->nick_name;
      $prof->email = $request->email;
      $prof->adresa = $request->adresa;
      $prof->oras = $request->oras;
      $prof->scoala = $request->scoala;
      $prof->activ = $request->activ;
      $prof->blog = $request->blog;
      $prof->text = $request->text;
      $prof->userid = $user->id;

      $prof->save();
      $prof_id = $prof->id;
      $about = new About;
      $about->title = 'about me';
      $about->body = 'I am...';
      $about->prof_id = $prof_id;
      $about->userid = $user->id;
      $about->save();
      return redirect()->route('prof');    
    }

    public function updateProf(Request $request, $id)
    {    
     
     $user = Auth::user();
     $prof =Prof::find($id);

if ($prof->email != $request->email){
     $this->validate($request, array(
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'nick_name' => 'required|max:255',      
      'email' => 'required|email|max:255|unique:profs',
      'activ' => 'required|integer|min:0|max:1',
      'blog' => 'required|integer|min:0|max:1'
      ));
   } else{
       $this->validate($request, array(
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'nick_name' => 'required|max:255',      
      'activ' => 'required|integer|min:0|max:1',
      'blog' => 'required|integer|min:0|max:1'
      ));
   }     
     

     $prof->first_name = $request->first_name;
     $prof->last_name = $request->last_name;
     $prof->nick_name = $request->nick_name;
     $prof->email = $request->email;
     $prof->adresa = $request->adresa;
     $prof->oras = $request->oras;
     $prof->scoala = $request->scoala;
     $prof->activ = $request->activ;
     $prof->blog = $request->blog;
     $prof->text = $request->text;
     $prof->userid = $user->id;
     $prof->save();

     return redirect()->route('prof');  
   }
 }