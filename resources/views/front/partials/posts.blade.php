@if($posts)
    {{ $posts->render() }}
@endif

@forelse($posts as $post)
    <div class="article col-xs-12">
        <h3>{{ $post->title }}</h3>
        <p>{{ $post->excerpt(10) }}</p>
        <a class="btn btn-default" href="{{ Action('FrontController@show', $post->id)}}">En savoir plus...</a>

        @if($author = $post->user)
            <p class="author">Écrit par {{ $post->user->name }}
                le {{ $post->published_at }}</p>
        @endif

        @if($category = $post->category)
            <p>Dans la catégorie : <a
                        href="{{ Action('FrontController@showPostByCat', $category->id)}}">{{$category->title}}</a>
            </p>
        @endif

        @if($tags = $post->tags)
            <ul class="tags">
                <li>Mots clés :</li>
                @foreach($tags as $tag)
                    <li>{{ $tag->name }}</li>
                @endforeach
            </ul>
        @endif

        @if($picture = $post->picture)
            <div class="picture">
                <img src="{{ asset('uploads/'.$post->picture->uri) }}" alt="" class="img-responsive">
            </div>
        @endif
    </div>
@empty
    <p>Aucun article</p>
@endforelse