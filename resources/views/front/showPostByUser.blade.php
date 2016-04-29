@extends('layouts.master')

@section('title', $title)

@section('content')

<h1>Les posts de {{ $user->name }}</h1>

@foreach($posts as $post)

<h3><a href="{{ Action('FrontController@show', $post->id)}}">{{ $post->title }}</a></h3>
<p>{{ $post->excerpt(10) }}</p>
@if($category = $post->category)
<p>Dans la catégorie : <a href="{{ Action('FrontController@showPostByCat', $category->id)}}">{{$category->title}}</a></p>
@endif

@endforeach

@stop

@section('sidebar')
    <a href="">J'aimerai être à la suite de la sidebar</a>
@stop