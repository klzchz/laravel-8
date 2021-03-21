<h2>Posts</h2>

<h3><a href="{{route('posts.create')}}">Criar Novo Post </a></h3>
<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
    </tr>

        @foreach($posts as $post)
        <tr>
        <td>{{$post->title}}</td>
        <td>{{$post->content}}</td>
        </tr>
        @endforeach

</table>
