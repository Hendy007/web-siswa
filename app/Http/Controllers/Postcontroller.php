<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class Postcontroller extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	return view('posts.index',compact(['posts']));
    }

    public function add()
    {
    	return view('posts.add');
    }

    public function create(Request $request)
    {
    	$post = Post::create([
    		'title' => $request->title,
    		'content' => $request->content,
    		'user_id' => auth()->user()->id,
    		'thumbnail' => $request->thumbnail
    	]);

    	return redirect()->route('posts.index')->with('sukses','Post Berhasil di Simpan');
    }

    public function edit(Post $post)
    {
        return view('posts/edit',['post' => $post]);
    }

    public function update(Request $request,Post $post)
    {
       $post->update($request->all());
        return redirect('/posts')->with('sukses','Data Berhasil Diupdate');
    }

    public function delete(Post $post)
    {
       $post->delete($post);
       return redirect('/posts')->with('sukses','Data Berhasil Dihapus');
    }
}
