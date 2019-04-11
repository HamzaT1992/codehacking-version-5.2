<?php

namespace App\Http\Controllers;

use App\Post;

use App\Photo;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
            'photo_id'    => 'required',
            'title'       => 'required',
            'body'        => 'required',
        ]);

        // $user = Auth::user();
        $input = $request->all();
        $input['user_id'] = Auth::user()->id;
        $name = Photo::addImage($request->file('photo_id'));
        $photo = Photo::create(['file' => $name]);
        $input['photo_id'] = $photo->id;

        Post::create($input);

        return redirect('admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::lists('name', 'id')->all();
        return View('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $user = Auth::user();
        $post = Post::findOrFail($id);
        $input = [];
        if ($file = $request->file('photo_id')) {
            $input = $request->all();
            unlink(public_path() . $post->photo->file);
            $name = Photo::addImage($file);
            $photo = Photo::create(['file' => $name]);
            $input['photo_id'] = $photo->id;
        }
        else
            $input = $request->except('photo_id');

        $post->update($input);

        return redirect('admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (isset($post->photo)) {
            unlink(public_path() . $post->photo->file);
            $post->photo->delete();
        }
            
        $post->delete();
        Session::flash('post_deleted', 'Post has been deleted');

        return redirect('admin/posts');
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();

        return view('post', compact('post', 'categories'));
    }
}
