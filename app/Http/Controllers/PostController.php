<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post){
        $this->post = $post;
    }


    public function index()
    {
        $posts = $this->post->all();
        return view('admin.posts.index',compact('posts'));
    }
}
