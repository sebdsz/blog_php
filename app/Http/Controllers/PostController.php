<?php

namespace App\Http\Controllers;

use Auth;
use File;
use Gate;
use App\Post;
use App\Picture;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;

        return view('admin.post.create', compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());
        $post->user_id = Auth::user()->id;
        $post->touch();

        if (!empty($request->input('tag_id')))
            $post->tags()->attach($request->input('tag_id'));

        $this->upload($request, $post);

        return redirect('dashboard')->with('message', 'Publication ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::denies('show', $post)) {
            abort(403, 'Sorry');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        /*if (Gate::denies('show', $post)) {
            abort(403, 'Sorry');
        }*/

        return view('admin.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        if (!empty($request->input('tag_id')))
            $post->tags()->sync($request->input('tag_id'));

        $this->upload($request, $post);
        $this->deletePicture($request, $post);


        return back()->with('message', 'Publication modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;

        $post->delete();

        return back()->with(['message' => sprintf('success delete ressource %s', $title)]);
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     */
    private function deletePicture(PostRequest $request, Post $post)
    {
        if (!empty($request->input('deletePicture'))) {
            $picture = Picture::findOrFail($post->picture->id);

            $fileName = env('UPLOAD_PICTURES', 'uploads') . DIRECTORY_SEPARATOR . $picture->uri;

            if (File::exists($fileName))
                File::delete($fileName);

            $picture->delete();
        }
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     */
    private function upload(PostRequest $request, Post $post)
    {
        if (!empty($request->file('picture'))) {

            if ($post->picture)
                $this->deletePicture($request, $post);

            $img = $request->file('picture');
            $ext = $img->getClientOriginalExtension();
            $uri = str_random(50) . '.' . $ext;

            Picture::create([
                'name' => $request->input('name'),
                'uri' => $uri,
                'size' => $img->getSize(),
                'mime' => $img->getClientMimeType(),
                'post_id' => $post->id,
            ]);

            $img->move(env('UPLOAD_PICTURES', 'uploads'), $uri);
        }
    }

    public function published(Post $post)
    {
        $post->status === 'published' ? $post->status = 'unpublished' : $post->status = 'published';
        $post->touch();

        return back();
    }

}
