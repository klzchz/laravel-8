<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
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

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
            $dataForm = [
                'title'=>$request->title,
                'content'=>$request->content
            ];

            $response =$this->post->create($dataForm);

            if($response)
                    return redirect()->route('posts.index')->withSucces('Post Criado com Sucesso');
            else
                return redirect()->route('posts.create')->withSucces('Falha ao Cadastrar Post');


    }
}
