<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'SiteController@home');
route::get('/register','SiteController@register');
route::post('/postregister','SiteController@postregister');


route::get('/login','AuthController@login')->name('login');
route::post('/postlogin','AuthController@postlogin');
route::get('/logout','AuthController@logout');




route::group (['middleware' => ['auth','CheckRole:admin']],function(){
		route::get('/siswa','SiswaController@index');
		route::post('/siswa/create','SiswaController@create');
		route::get('/siswa/{siswa}/edit','SiswaController@edit');
		route::post('/siswa/{siswa}/update','SiswaController@update');
		route::get('/siswa/{siswa}/delete','SiswaController@delete');
		route::get('/siswa/{siswa}/profile','SiswaController@profile');
		route::post('/siswa/{id}/addnilai','SiswaController@addnilai');
		route::get('/siswa/{siswa}/{idmapel}/deletenilai','SiswaController@deletenilai');
		route::get('/siswa/exportexcel','SiswaController@exportExcel');
		route::get('/siswa/exportpdf','SiswaController@exportPdf');
		route::get('/guru/{id}/profile','GuruController@profile');
		route::get('/posts','PostController@index')->name('posts.index');
		route::get('/post/add', [
				'uses' => 'PostController@add',
				'as' => 'posts.add',
			]);
		route::post('/post/create', [
				'uses' => 'PostController@add',
				'as' => 'posts.create',
			]);

		route::get('/post/edit', [
				'uses' => 'PostController@edit',
				'as' => 'posts.edit',
			]);
		route::post('/post/update', [
				'uses' => 'PostController@update',
				'as' => 'posts.update',
			]);
		route::get('/post/delete', [
				'uses' => 'PostController@delete',
				'as' => 'posts.delete',
			]);

		
});

route::group (['middleware' => ['auth','CheckRole:admin,siswa']],function(){
	route::get('/dashboard','DashboardController@index');
	route::get('/forum', 'ForumController@index');
	route::post('/forum/create', 'ForumController@create');
	route::get('/forum/{forum}/view', 'ForumController@view');
	route::post('/forum/{forum}/view', 'ForumController@postkomentar');
});

route::group (['middleware' => ['auth','CheckRole:siswa']],function(){
	route::get('profilsaya','SiswaController@profilsaya');
	route::get('profilsaya/{siswa}/edit','SiswaController@edit');
		route::post('profilsaya/{siswa}/update','SiswaController@update');
	
});

route::get('/getdatasiswa',[
	'uses' => 'SiswaController@getdatasiswa',
	'as' => 'ajax.get.data.siswa',
]);

route::get('/{slug}',[
	'uses' => 'SiteController@singlepost',
	'as' => 'site.single.post'
]);