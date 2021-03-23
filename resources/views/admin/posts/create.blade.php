@extends('admin.layouts.app')

@section('title','Criando Posts')

@section('content')

    <h2>Cadastrando Post</h2>

    <form action="{{route('posts.store')}}" method="post">
        @csrf
        @include('admin.posts.partials._form')
    </form>

@endsection
