<?php

namespace App\Http\Controllers;

use Auth;
use Gate;
use View;
use Cache;
use App\Post;
use App\Score;
use App\Category;
use App\Http\Requests;
use App\Http\Requests\ScoreRequest;

class FrontController extends Controller
{

    public function index()
    {
        $posts = Post::with('category', 'user', 'tags', 'picture')->published()->paginate(10);
        $title = "Blog PHP - Laravel";

        return view('front.index', compact('posts', 'title'));
    }

    public function show($id)
    {
        $posts = Post::with('category', 'user', 'tags', 'picture')->published()->paginate(10);
        $single = Post::published()->findOrFail($id);
        $total = $single->averageScore();
        $title = 'Blog PHP - Publication - ' . $single->title;

        return view('front.single', compact('posts', 'single', 'title', 'total'));
    }

    public function showPostByCat($id = null)
    {
        if (!$id) {
            $categories = Category::all();
            $title = 'Toutes les catégories';

            return view('front.categories', compact('categories', 'title'));
        }

        $category = Category::findOrFail($id);
        $title = $category->title;
        $posts = Post::with('category', 'user', 'tags', 'picture')->category($id)->published()->paginate(10);

        return view('front.category', compact('category', 'title', 'posts'));
    }

    public function setScorePost(ScoreRequest $request, Post $post)
    {
        $score = new Score;
        $score->post_id = $post->id;
        $score->user_id = Auth::user()->id;
        $score->score = $request->input('score');
        $score->touch();

        return back();
    }

}
