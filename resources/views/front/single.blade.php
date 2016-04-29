@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                @include('front.partials.posts')
            </div>
            <div class="col-md-6">
                <h2>{{ $single->title }}</h2>
                <p>{{ $single->content }}</p>

                @if($author = $single->user)
                    <p>{{ $single->user->name }}</p>
                @endif

                @if($category = $single->category)
                    <p>Dans la catégorie : <a
                                href="{{ Action('FrontController@showPostByCat', $category->id)}}">{{$category->title}}</a>
                    </p>
                @endif

                @if($tags = $single->tags)
                    <ul>
                        @foreach($tags as $tag)
                            <li>{{ $tag->name }}</li>
                        @endforeach
                    </ul>
                @endif

                <p class="italic">Crée le {{ $single->published_at->format('d-m-Y') }}</p>

                @if($picture = $single->picture)
                    <div class="picture">
                        <img src="{{ asset('uploads/'.$single->picture->uri) }}" alt="" class="img-responsive">
                    </div>
                @endif

                @if($averageScore = $single->averageScore())
                    <div class="total">
                        <p>La note moyenne de cet article est de : {{$averageScore}}.</p>
                    </div>
                @endif
                @can('rate', $single)
                <form action="{{ action('FrontController@setScorePost', $single) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="score" class="form-label">Donnez une note à cet article</label>
                        <select name="score" id="score" class="form-control">
                            @for($i = 0; $i <= 20; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <input type="submit" value="Noter" class="btn btn-primary">
                </form>
                @else
                    @if(!Auth::check())
                        <p>Veuillez vous <a href="{{url('/login')}}">connecter</a> pour pouvoir noter cet article.</p>
                    @else
                        <p>Vous avez déjà voté pour cet article.</p>
                    @endif
                    @endcan
            </div>
        </div>
    </div>
@endsection