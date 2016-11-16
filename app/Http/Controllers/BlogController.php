<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Post;
use App\Home;
use App\Prof;
use DB;
class BlogController extends Controller
{

    public function getIndex() {
        //$i=1;
        $profi = Prof::all();
     
        return view('blog.bloguri')->with(['profi' => $profi]);
    }
    public function getPopular()
    {
        $home = Home::find(1);
        $paginate = false;
        return view('pages.home')->with(['home' => $home]);
    }
    public function getSingle($slug) {
        //fetch from the database based on a slug
        $post = Post::where('slug', '=', $slug)->first();

        //return view
        return view('blog.single')->withPost($post);
    }

        public function getBlogPart($id) {

        //$posts = Post::where('vizibil', '=',1)->orderBy('created_at', 'DESC')->paginate(3);
        $prof = Prof::find($id);    
        $posts = Post::where('prof_id', '=', $id)->where('vizibil', '=',1)->orderBy('updated_at', 'DESC')->paginate(3);
        //if (!$posts) $posts = [];
        $paginate = true;
        //return view('blog.index')->withPosts($posts,$paginate);
        return view('blog.index')->with(['id' => $id, 'prof' => $prof, 'posts' => $posts, 'paginate' => $paginate]);
    }
}
