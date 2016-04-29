@extends('layouts.admin')

@section('content')

    <div class="container">
        @if(Session::has('message'))
            <p>{{ Session::get('message') }}</p>
        @endif
        <form action="{{ action('PostController@store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title" class="form-label">Titre de la publication</label>
                <input type="text" id="title" name="title" placeholder="Votre titre" class="form-control">
                @if($errors->has('title')) <span class="error">{{ $errors->first('title') }}</span> @endif
            </div>
            <div class="form-group">
                <label for="content">Contenu de la publication</label>
                <textarea name="content" id="content" class="form-control"></textarea>
            </div>
            @if($errors->has('content')) <span class="error">{{ $errors->first('content') }}</span> @endif
            <div class="form-group">
                <label for="category" class="form-label">Catégorie</label>
                <select name="category_id" id="category" class="form-control">
                    @foreach(App\Category::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                    <option value="0" selected>Non catégorisé</option>
                </select>
                @if($errors->has('category_id')) <span class="error">{{ $errors->first('category_id') }}</span> @endif
            </div>
            <div class="form-group">
                <label for="published_at" class="form-label">Date de publication</label>
                <input type="date" name="published_at" id="published_at" class="form-control">
                @if($errors->has('published_at')) <span class="error">{{ $errors->first('published_at') }}</span> @endif
            </div>
            
            <div class="form-select">
                <label for="tag_id">Tags</label>
                <select name="tag_id[]" id="tag_id" multiple>
                @foreach(App\Tag::lists('name', 'id') as $id => $name)
                   <option value="{{$id}}">{{$name}}</option>
                @endforeach
                </select>
             </div>

            <div class="form-group">
                <label for="picture">image</label>
                <input type="file" name="picture">
            </div>
            <div class="form-group">
                <label for="name">image name</label>
                <input type="text" name="name" placeholder="Nom de l'image">
            </div>
             
            <input type="submit" value="ok" class="btn btn-primary">
        </form>
    </div>
@endsection