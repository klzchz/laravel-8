<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    private $post;
    protected $page;

    public function __construct(Post $post){
        $this->post = $post;
        $this->page = 1;
    }


    public function index()
    {
        $posts = $this->post->latest()->paginate($this->page);
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

    public function show($id)
    {
        $post = $this->post->find($id);

        if(!$post)
                return redirect()->back();

        return view('admin.posts.show',compact('post'));
    }

    public function destroy($id)
    {
        $post = $this->post->find($id);

        if(!$post)
            return redirect()->route('posts.index')->withErrors('Erro ao Deletar');

        $post->delete();

        return redirect()->route('posts.index')->with('message','Post Deletado com Sucesso !');

    }
    public function  edit($id)
    {
        $post = $this->post->find($id);

        if(!$post)
            return redirect()->back();

        return view('admin.posts.edit',compact('post'));
    }

    public function update(StoreUpdatePost  $request,$id)
    {

        $post = $this->post->find($id);

        if(!$post)
            return redirect()->back();

        $post->update($request->all());

        return redirect()
            ->route('posts.index')
            ->with('message','Post Atualizado com Sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $posts = Post::where('title','LIKE',"%{$request->search}%")
                        ->orWhere('content','LIKE',"%{$request->search}%")
                        ->paginate($this->page);

        return view('admin.posts.index',compact('posts','filters'));
    }


}
