<h2>Cadastrando Post</h2>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif
<form action="{{route('posts.store')}}" method="post">
    @csrf
    <input type="text" name="title" id="title" placeholder="Título" value="{{old('title')}}"/>
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Conteudo">{{old('content')}}</textarea>
    <button type="submit">Enviar</button>
</form>
