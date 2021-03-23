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
        <th>Title</th>
        <th>Content</th>
        <th>Ação</th>
    </tr>

        @foreach($posts as $post)
        <tr>
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


