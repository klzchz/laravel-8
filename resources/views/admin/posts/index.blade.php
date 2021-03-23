<h2>Posts</h2>

<h3><a href="{{route('posts.create')}}">Criar Novo Post </a></h3>
@if(session('message'))
    <div>
        {{session('message')}}
    </div>
@endif

<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Ver</th>
    </tr>

        @foreach($posts as $post)
        <tr>
        <td>{{$post->title}}</td>
        <td>{{$post->content}}</td>
        <td><a href="{{route('posts.show',$post->id)}}">Ver</a></td>
        </tr>
        @endforeach

</table>
