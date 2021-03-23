<h2>{{$post->title}}</h2>

<p>
{{$post->content}}
</p><br/>

<form action="{{route('posts.destroy',$post->id)}}" method="POST">
    @method('DELETE')
    @csrf
    <button type="submit">Deletar o Post {{$post->id}}</button>

</form>
