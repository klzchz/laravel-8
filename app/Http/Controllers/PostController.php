<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUpdatePost;
use Illuminate\Support\Facades\Storage;

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
            if($request->file('image')){

                $nameFile = Str::of($request->image)->slug('-').'.'.$request->image->extension();

                $image =  $request->image->storeAs('posts',$nameFile);
                $dataForm['image'] = $image;

            }

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
            $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($post->image))
                Storage::delete($post->image);

            $nameFile = Str::of($request->title)->slug('-') . '.' .$request->image->getClientOriginalExtension();

            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;
        }


        $post->update($data);

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
