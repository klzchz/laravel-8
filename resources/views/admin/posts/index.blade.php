<h2>Posts</h2>


<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
    </tr>
    <tr>
        @foreach($posts as $post)
        <td>{{$post->title}}</td>
        <td>{{$post->content}}</td>
        @endforeach
    </tr>
</table>
