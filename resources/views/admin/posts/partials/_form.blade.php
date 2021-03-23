
@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{$error}}</p>
    @endforeach
@endif
    <input type="file" name="image" id="image">
    <input type="text" name="title" id="title" placeholder="Título" value="{{isset($post) ? old('title') ?? $post->title : old('title')}}"/>
    <textarea name="content" id="content" cols="30" rows="10" placeholder="Conteudo">{{isset($post) ? old('content') ?? $post->content : old('content')}}</textarea>
    <button type="submit">Enviar</button>

