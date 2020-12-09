<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Siswa;
use App\Post;
use App\Mail\NotifPendaftaranSiswa;

class SiteController extends Controller
{
    public function home()
    {
      $posts = Post::all();
    	return view('sites.home',compact(['posts']));
    }

    public function about()
    {
    	return view('sites.about');
    }

    public function register()
    {
    	return view('sites.register');
    }

    public function postregister(Request $request)
    {
       $user = new \App\User;
       $user->role ='siswa';
       $user->name = $request->nama_depan;
       $user->email = $request->email;
       $user->password = bcrypt($request->password);
       $user->remember_token = Str::random(60);
       $user->save();

       $request->request->add(['user_id' => $user->id ]);
        $siswa = \App\Siswa::create($request->all());

        \Mail::to($user->email)->send(new NotifPendaftaranSiswa);
        return redirect('/login')->with('sukses','Berhasil di Simpan'); 
    }

    public function singlepost($slug)
    {
      $post = Post::where('slug','=',$slug)->first();
      return view('sites.singlepost',compact(['post']));
    }
}
