@extends('layouts.admin')

@section('content')

    <div class="container">
        @if(Session::has('message'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <strong>Cool !</strong> {{ Session::get('message') }}
            </div>
        @endif

        <form action="{{ action('PostController@update', $post->id) }}" method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="status" class="form-label">Status de la publication</label>
                <select name="status" id="status" class="form-control">
                    <option value="unpublished" @if($post->status == 'unpublished') selected @endif>unpublished</option>
                    <option value="published" @if($post->status == 'published') selected @endif>published</option>
                </select>
            </div>
            <div class="form-group">
                <label for="score" class="form-label">Score</label>
                <input type="number" max="20" min="0" value="{{$post->averageScore()}}" class="form-control">
            </div>
            <div class="form-group">
                <label for="title" class="form-label">Titre de la publication</label>
                <input type="text" id="title" name="title" placeholder="Votre titre" value="{{ $post->title }}"
                       class="form-control">
                @if($errors->has('title')) <span class="error">{{ $errors->first('title') }}</span> @endif
            </div>
            <div class="form-group">
                <label for="content">Contenu de la publication</label>
                <textarea name="content" id="content" class="form-control">{{ $post->content }}</textarea>
            </div>
            @if($errors->has('content')) <span class="error">{{ $errors->first('content') }}</span> @endif
            <div class="form-group">
                <label for="category" class="form-label">Catégorie</label>
                <select name="category_id" id="category" class="form-control">
                    @foreach(App\Category::all() as $category)
                        @if($post->category_id == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endif
                    @endforeach
                    <option value="0" selected>Non catégorisé</option>
                </select>
                @if($errors->has('category_id')) <span class="error">{{ $errors->first('category_id') }}</span> @endif
            </div>
            <div class="form-group">
                <label for="published_at" class="form-label">Date de publication</label>
                <input type="date" name="published_at" id="published_at" class="form-control"
                       value="{{ $post->published_at->format('Y-m-d') }}">
                @if($errors->has('published_at')) <span class="error">{{ $errors->first('published_at') }}</span> @endif
            </div>

            <div class="form-select">
                <label for="tag_id">Tags</label>
                <select name="tag_id[]" id="tag_id" multiple class="form-control">
                    @foreach(App\Tag::lists('name', 'id') as $id => $name)
                        <option value="{{$id}}" {{ $post->hasTag($id) ? 'selected' : '' }}>{{$name}}</option>
                    @endforeach
                </select>
                @if($errors->has('tag_id')) <span class="error">{{ $errors->first('tag_id') }}</span> @endif
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="picture" class="form-label">image</label>
                    <input type="file" name="picture">
                    @if($errors->has('picture')) <span class="error">{{ $errors->first('picture') }}</span> @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="name" class="form-label">image name</label>
                    <input type="text" name="name" placeholder="Nom de l'image" class="form-control">
                    @if($errors->has('name')) <span class="error">{{ $errors->first('name') }}</span> @endif
                </div>
            </div>
            @if($post->picture)
                <div class="picture">
                    <img src="{{ asset('uploads/'.$post->picture->uri) }}" class="img-responsive">
                    <input type="checkbox" name="deletePicture"> Supprimer l'image
                </div>
            @endif

            <input type="submit" value="ok" class="btn btn-primary">
        </form>
    </div>
@endsection