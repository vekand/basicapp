<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Post;
use App\Prof;
use App\Tag;
use App\User;
use App\Category;
use Session;
use Purifier;
use Image;
use DB;


class PostController extends Controller
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
        // create a variable and store all the blog posts on the database
      $user = Auth::user();
      $prof_id = $user->prof_id;
      //$posts = Post::orderBy('id', 'DESC')->paginate(5);

      if ($user->prof_id == 1){  //superuser
       $posts = Post::orderBy('updated_at', 'DESC')->paginate(11);
     }
     else if ($user->prof_id > 1){ //admin
          //$posts = Post::where('user_id', '=', $user->id)->orderBy('id', 'DESC')->paginate(5);
      $posts = Post::where('prof_id', '=', $prof_id)->orderBy('updated_at', 'DESC')->paginate(11);
    }
    return view('posts.index')->withPosts($posts)->withUser($user);
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::all();
      $tags = Tag::all();
      return view('posts.create')->withCategories($categories)->withTags($tags);
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
        'title'         =>'required|max:255',
        'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        'category_id'   => 'required|integer',
        'body'          => 'required',
        'fisier'          => 'mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,jpeg,jpg,png,gif | max:2000'
        //'fisier'          => 'sometimes|image'
        ));

        // Store in the database
      $post = new Post;
      $user = Auth::user();
      $prof_id = $user->prof_id;
      $post->title = $request->title;
      $post->slug = $request->slug;
      $post->category_id = $request->category_id;
      $post->body = Purifier::clean($request->body);
      $post->vizibil = $request->vizibil;
      $post->publicu = $request->publicu;
      $post->user_id = $user->id;
      $post->userid = $user->id;
      $post->prof_id = $prof_id;


      $post->save();

      $filename = '';

      if ($request->file('fisier')){
        $file = $request->file('fisier');
        $filename = 'post'.$post->id.'.'.$file->getClientOriginalExtension();
        //$filename = 'post'.$post->id.'.'.$file->encode('png'); // trensform to PNG file
        //$locattion = public_path('/app/posts/').$filename; // direct path
        //$locattion = asset('app/posts').$filename; // url
        //Image::make($file)->resize(400 , 300)->save($locattion);
        
        $post->fisier = $filename; 
        $post->update(); 
        if ($filename){
          Storage::disk('posts')->put($filename, File::get($file));
        }

      } 

      

      if (isset($request->tags)){
            $post->tags()->sync($request->tags, false); // post-tag table (manytomany)
          }

          Session::flash('success', 'The blog post was successfully save!');

        // Redirect to another page
          return redirect()->route('posts.show', $post->id);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = Auth::user();
      $post = Post::find($id);
      return view('posts.show')->withPost($post)->withUser($user);
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
      $user = Auth::user();
      $post = Post::find($id);
      $categories = Category::all();
      $cats = [];

      foreach($categories as $category) {
        $cats[$category->id] = $category->name;
      }

      $tags = Tag::all();
      $tags2= array();
      foreach($tags as $tag) {
        $tags2[$tag->id] = $tag->name;
      }
        // Return the view and pass in the var
      return view('posts.edit')->withPost($post)->withCategories($cats)->withTags($tags2)->withUser($user);
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
      $post = Post::find($id);
        // Validate the data
    /*  if($request->input('slug') == $post->slug){
        $this->validate($request, array(
          'title' =>'required|max:255',
          'category_id'   => 'required|integer',
          'body' => 'required',
          'fisier'          => 'sometimes|image'
          ));
      }else{*/
        $this->validate($request, array(
          'title' =>'required|max:255',
          'slug' => "required|alpha_dash|min:5|max:255|unique:posts,slug,$id",
          'category_id' => 'required|integer',
          'body' => 'required',
          'fisier'          => 'mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv,jpeg,jpg,png,gif | max:2000'
          //'fisier' => 'sometimes|image'
          ));
     // }

        // Save the data into the database
      $user = Auth::user();
      $prof_id = $user->prof_id;
      $post->title = $request->input('title');
      $post->slug = $request->input('slug');
      $post->category_id = $request->category_id;
      $post->body = Purifier::clean($request->input('body'));
      $post->vizibil = $request->vizibil;
      $post->publicu = $request->publicu;
      $post->user_id = $user->id;
      $post->userid = $user->id;
      $post->prof_id = $prof_id;

      $post->save();

      $filename = '';

        //if ($request->hasFile('fisier')){   // alta varianta

      if ($request->file('fisier')){
        $file = $request->file('fisier');
        $filename = 'post'.$post->id.'.'.$file->getClientOriginalExtension();
        //$filename = 'post'.$post->id.'.'.$file->encode('png'); // trensform to PNG file
        //$locattion = storage_path('app/posts/').$filename; // direct path
        //$locattion = asset('app/posts').$filename; // url
        //Image::make($file)->resize(400 , 300)->save($locattion);
        
        $post->fisier = $filename; 
        $post->update();   
        if ($filename){
          Storage::disk('posts')->put($filename, File::get($file));
        }   

      } 


      if (isset($request->tags)){
            $post->tags()->sync($request->tags, true); // post-tag table (manytomany)
          } else{
            $post->tags()->sync(array());
          }

        // set flash data with success message
          Session::flash('success', 'This post was successfully saved.');

        // Redirect with flash data to posts.show
          return redirect()->route('posts.show', $post->id);
        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::find($id);
      $post->tags()->detach();
      Storage::disk('posts')->delete($post->fisier);
      $post->delete();


      Session::flash('success', 'The post was successfully deleted.');

      return redirect()->route('posts.index');
    }
  }
