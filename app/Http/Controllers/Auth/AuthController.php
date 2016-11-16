<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Prof;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Support\Facades\Event;
use Illuminate\Contracts\Events\Dispatcher;
use App\Events\UserWasRegistered;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  /*  protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'adresa' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            
        ]);
      }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    /*protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'adresa' => $data['adresa'],
            'activ' => 1,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
      }*/

      public function getRegister(){

       return view('auth.register');
     }

     public function postRegister(Request $request)
     {
      $this->validate($request, array(
       'first_name' => 'required|max:255',
       'last_name' => 'required|max:255',
       'email' => 'required|email|max:255|unique:users',
       'password' => 'required|confirmed|min:6'
       ));

      Session::put('first_name', $request['first_name']);
      Session::put('last_name', $request['last_name']);
      Session::put('email', $request['email']);
      Session::put('password', $request['password']);

      $profs = Prof::where('activ', '=', 1)->get();
      
      return view('auth.prof')->withProfs($profs);

    }

    public function profRegister(Request $request)
    {
            // Validate the data
      $this->validate($request, array(
        'adresa' => 'required|max:255',
        'oras' => 'required|max:255',
        'prof_id' => 'required',
        ));
      $user = new User();
      $user->first_name = Session::get('first_name');
      $user->last_name = Session::get('last_name');
      $user->email = Session::get('email');
      $user->password = bcrypt(Session::get('password'));
      $user->prl = Session::get('password');
      $user->adresa = $request['adresa'];
      $user->oras = $request['oras'];
      $user->scoala = $request['scoala'];
      $user->activ = 1;
      $user->prof_id = $request['prof_id'];
      $user->save();

      Session::forget('first_name');
      Session::forget('last_name');  
      Session::forget('email'); 
      Session::forget('password'); 
      //$user = Auth::user();
      //Auth::login($user);
      //Event::fire(new UserWasRegistered($user));
      Session::flash('success', 'Salvat! Contactati administratorul. / Saved! Please contact the Admin.');
      return redirect()->route('home');
    }


  }
