<?php

namespace App\Http\Controllers;

use App\Providers\AppServiceProvider;
use Illuminate\Http\Request;

use Auth;
use Gate;
use Illuminate\Support\Facades\App;
use View;
use Cache;
use App\User;
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

        $single = Post::findOrFail($id);

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

    /*public function showPostByUser($id)
    {

        $user = User::findOrFail($id);
        $posts = User::find($id)->posts;
        $title = $user->name;

        return view('front.showPostByUser', compact('posts', 'title', 'user'));
    }*/

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
