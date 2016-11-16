<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Tag;
use Session;

class TagController extends Controller
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
           // create a variable and store all the blog tags on the database
        $tags = Tag::orderBy('id', 'DESC')->paginate(5);

        //return a view and pass in the above variable
        return view('tags.index')->withTags($tags);
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
            'name'         =>'required|max:255'
            ));

        // Store in the database
        $user = Auth::user();
        $tag = new Tag; 
        $tag->name = $request->name;
        $tag->userid = $user->id;
        $tag->save();

        Session::flash('success', 'The tag was successfully save!');

        // Redirect to another page
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return view('tags.show')->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);
        return view('tags.edit')->withTag($tag);
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
       $this->validate($request, array(
        'name'         =>'required|max:255'
        ));
        $user = Auth::user();
       $tag = Tag::find($id);
       $tag->name = $request->name;
       $tag->userid = $user->id;
       $tag->save();

       Session::flash('success', 'The tag was successfully saved!');

        // Redirect to another page
       return redirect()->route('tags.index');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();
        Session::flash('success', 'The tag was successfully deleted.');
        return redirect()->route('tags.index');
    }
}
