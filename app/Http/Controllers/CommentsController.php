<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Post;
use Session;

class CommentsController extends Controller
{
     public function __construct()
  {
    $this->middleware('auth', ['except' => 'store']);  // to allow guest to put comments
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        // Validate the data
        $this->validate($request, array(
            'name'         =>'required|max:255',
            'email'          => 'required|email|max:255',
            'comment'   => 'required|min:5|max:2000'
            ));

        // Store in the database
        $comment = new Comment;
        $post = Post::find($post_id);

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->approved =true;

        $comment->post()->associate($post); // from relation

        $comment->save();

        if (isset($request->tags)){
            $comment->posts()->sync($post->id, false); // post-tag table (manytomany)
        }

        Session::flash('success', 'Comment was successfully saved!');

        // Redirect to another page
        return redirect()->route('blog.single', [$post->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $comment = Comment::find($id);
      return view('comments.edit')->with('comment', $comment);
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
      $comment = Comment::find($id);

      $this->validate($request, array(
          'comment'         => 'required|max:2000'
          ));

      $comment->comment = $request->comment;
      $comment->save();

      Session::flash('success', 'The comment was successfully updated.');

      return redirect()->route('posts.show', $comment->post->id);
  }

   public function delete($id)
    {
        $comment = Comment::find($id);

        return view('comments.delete')->withComment($comment);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = comment::find($id);
        $post_id = $comment->post->id;
        $comment->delete();

        Session::flash('success', 'The comment was successfully deleted.');

        return redirect()->route('posts.show', $post_id);

    }

  
}
