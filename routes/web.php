<?php

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
//test
Route::get('/createfaker',function(){
  session(["sess"=>"test"]);
});
Route::get('/readfaker',function(){
  var_dump(session()->all());
});
Route::get('/flushfaker',function(){
  // var_dump(session()->all());
  session()->flush();
});

//Landing
Route::get('/', "LandingController@index");
Route::get('/masuk',"LandingController@login");
Route::post('/masuk',"LandingController@loginproses");
//Admin
Route::get('/admin', "AdminController@index");
Route::get('/admin/jurusan', "AdminController@jurusan");

Route::get('/admin/readjurusan', "AdminController@readjurusan");
Route::post('/admin/addjurusan', "AdminController@addjurusan");
Route::post('/admin/deljurusan', "AdminController@deljurusan");
Route::post('/admin/upjurusan', "AdminController@upjurusan");

Route::get('/admin/mahasiswa', "AdminController@mahasiswa");

Route::get('/admin/readmahasiswa', "AdminController@readmahasiswa");
Route::post('/admin/addmahasiswa', "AdminController@addmahasiswa");
Route::post('/admin/delmahasiswa', "AdminController@delmahasiswa");
Route::post('/admin/upmahasiswa', "AdminController@upmahasiswa");

Route::get('/admin/keluar', "AdminController@logout");
//Dosen
Route::get('/dosen',function(){
  $css = [];
  $js = [];
  return view("dosen.pages.home")->with(["title"=>"Dashboard Dosen Perwalian","css"=>$css,"js"=>$js]);
});
Route::get('/dosen/keluar',function(){
  return redirect("/masuk")->send();
});
//sekretariat
Route::get('/sekretariat',function(){
  $css = [];
  $js = [];
  return view("sekertariat.pages.home")->with(["title"=>"Dashboard Dosen Perwalian","css"=>$css,"js"=>$js]);
});
Route::get('/sekretariat/keluar',function(){
  return redirect("/masuk")->send();
});
