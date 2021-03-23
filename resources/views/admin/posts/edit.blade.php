<h2>Editando Post</h2>


<form action="{{route('posts.update',$post->id)}}" method="post">
    @csrf
    @method('PUT')
   @include('admin.posts.partials._form')
</form>
