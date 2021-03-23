<h2>Editando Post</h2>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif
<form action="{{route('posts.update',$post->id)}}" method="post">
    @csrf
    @method('PUT')
    <input type="text" name="title" id="title" placeholder="Título" value="{{old('title') ?? $post->title}}"/>
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Conteudo">{{old('content') ?? $post->content}}</textarea>
    <button type="submit">Enviar</button>
</form>
