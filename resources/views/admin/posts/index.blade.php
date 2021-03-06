@extends('admin.layouts.app')

@section('title','Listagem de Posts')

@section('content')
    <h2>Posts</h2>

    <h3><a href="{{route('posts.create')}}">Criar Novo Post </a></h3>
    @if(session('message'))
        <div>
            {{session('message')}}
        </div>
    @endif

    <form action="{{route('posts.search')}}" method="post">
        @csrf
        <input type="text" name="search" placeholder="Filtrar" :>
        <button type="submit">Filtrar</button>
    </form>

    <table>
        <tr>
            <thead>
            <th>Imagem</th>
                <th>Title</th>
                <th>Content</th>
                <th>Ação</th>

            </thead>
        </tr>

        @foreach($posts as $post)
            <tr>
                <td width="200"><img src="{{url('storage/'.$post->image)}}"></td>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                <td><a href="{{route('posts.show',$post->id)}}">(Ver)</a> <a href="{{route('posts.edit',$post->id)}}">(Edit)</a></td>

            </tr>
        @endforeach

    </table>
    @if(isset($filters))
        {{$posts->appends($filters)->links()}}
    @else
        {{$posts->links()}}
    @endif


@endsection
