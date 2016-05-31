@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <h1>{{ $category->title }}</h1>
            <div class="col-md-6">

                @if($posts)
                    {{ $posts->render() }}
                @endif

                @foreach($posts as $post)
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->excerpt(10) }}</p>
                    <a href="{{ Action('FrontController@show', $post->id)}}">En savoir plus...</a>

                    @if($author = $post->user)
                        <p>{{ $post->user->name }}</p>
                    @endif

                    @if($category = $post->category)
                        <p>Dans la catégorie : <a
                                    href="{{ Action('FrontController@showPostByCat', $category->id)}}">{{$category->title}}</a>
                        </p>
                    @endif

                    @if($tags = $post->tags)
                        <ul>
                            @foreach($tags as $tag)
                                <li>{{ $tag->name }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <p class="italic">Crée le {{ $post->date() }}</p>

                    @if($picture = $post->picture)
                        <div class="picture">
                            <img src="{{ asset('uploads/'.$post->picture->uri) }}" alt="" class="img-responsive">
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="col-md-6">

            </div>
        </div>
    </div>
@endsection