<div class="container-fluid">
    <ul class="nav navbar-nav">
        <li><a href="{{ url('/') }}">Home</a></li>
        @forelse($categories as $id => $title)
            <li><a href="{{ Action('FrontController@showPostByCat', $id)}}">{{$title}}</a></li>
        @empty
        @endforelse
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Connexion</a></li>
            <li><a href="{{ url('/register') }}">Inscription</a></li>
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    @if( Auth::user()->isAdmin())
                        <li><a href="{{ action('PostController@index') }}">Dashboard</a></li>
                        <li><a href="{{ action('PostController@create') }}">Créer un article</a></li>
                    @endif
                    <li class="divider" role="separator"></li>
                    <li><a href="{{ url('/logout') }}">Logout</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>