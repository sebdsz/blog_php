@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-xs-12">

                @if(Session::has('message'))
                    <p>{{Session::get('message')}}</p>
                @endif

                @if($posts)
                    {{ $posts->render() }}
                @endif

                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Auteur</th>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Visuel</th>
                        <th>Catégorie</th>
                        <th>Mots clés</th>
                        <th>Note</th>
                        <th>Changer le statut</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    @forelse($posts as $post)
                        <tr>
                            <td>{{ $post->status }}</td>
                            <td>{{ $post->user_id ? $post->user->name : 'Aucun auteur' }}</td>
                            <td><a href="{{ action('PostController@edit', $post->id)}}">{{ $post->title }}</a></td>
                            <td>
                                {{ $post->published_at->formatLocalized('%A %d %B %Y') }}
                            </td>
                            <td>
                                @if($post->picture)
                                    <img src="{{ asset('uploads/'.$post->picture->uri) }}" class="img-responsive">
                                @endif
                            </td>
                            <td>
                                @if($category = $post->category)
                                    {{ $category->title }}
                                @endif
                            </td>
                            <td>
                                @if($tags = $post->tags)
                                    <ol>
                                        @foreach($tags as $tag)
                                            <li>{{ $tag->name }}</li>
                                        @endforeach
                                    </ol>
                                @endif
                            </td>
                            <td>
                                @if($averageScore = $post->averageScore())
                                    {{ $averageScore }}/20
                                @else
                                    Aucune note
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-danger"
                                   href="{{ action('PostController@published', $post) }}">{{ $post->status === 'published' ? 'Unpublished' : 'Published' }}</a>
                            </td>
                            <td>
                                <form action="{{ action('PostController@destroy', $post->id) }}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="delete btn btn-danger">Delete</button>
                                </form>
                            </td>
                            @empty
                                <p>aucun post</p>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection