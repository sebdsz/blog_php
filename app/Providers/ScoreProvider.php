<?php

namespace App\Providers;

use DB;
use App\Post;
use Illuminate\Support\ServiceProvider;

class ScoreProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        app('view')->composer(['front.index'], function ($view) {
            $best = DB::select('SELECT AVG(score) as average, post_id FROM scores GROUP BY post_id ORDER BY average DESC LIMIT 1');

            if ($best) {
                $bestPostScore = ceil($best[0]->average);
                $bestPost = Post::with('category', 'user', 'tags', 'picture')->find($best[0]->post_id);
            } else {
                $bestPostScore = null;
                $bestPost = null;
            }

            $view->with(compact('bestPostScore', 'bestPost'));

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
