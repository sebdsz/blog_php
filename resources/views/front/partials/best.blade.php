@if($bestPost)
    <div class="row">
        <div class="bestPost col-xs-12">
            <h2>Meilleur article ({{ $bestPostScore }}/20)</h2>
            <h3>{{$bestPost->title}}</h3>
            <p>{{ $bestPost->excerpt(10) }}</p>
            <a class="btn btn-default" href="{{ Action('FrontController@show', $bestPost->id)}}">En savoir plus...</a>

            @if($author = $bestPost->user)
                <p class="author">Écrit par {{ $bestPost->user->name }}
                    le {{ $bestPost->published_at }}</p>
            @endif

            @if($category = $bestPost->category)
                <p>Dans la catégorie : <a href="{{ Action('FrontController@showPostByCat', $category->id)}}">{{$category->title}}</a>
                </p>
            @endif

            @if($tags = $bestPost->tags)
                <ul class="tags">
                    <li>Mots clés :</li>
                    @foreach($tags as $tag)
                        <li>{{ $tag->name }}</li>
                    @endforeach
                </ul>

            @endif

            @if($picture = $bestPost->picture)
                <div class="picture">
                    <img src="{{ asset('uploads/'.$bestPost->picture->uri) }}" alt=""
                         class="img-responsive">
                </div>
            @endif
        </div>
    </div>
@endif