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
Route::get('/test',function(){
  // var_dump(session()->all());
  echo (stylePack())["css"];
  echo (stylePack())["js"];
});


// Landing
Route::get('/', "LandingController@index");
Route::get('/masuk',"LandingController@login");
Route::post('/masuk',"LandingController@loginproses");
// Admin
Route::get('/admin', "AdminController@index");
Route::get('/admin/jurusan', "AdminController@jurusan");

Route::get('/admin/readjurusan', "AdminController@readjurusan");
Route::post('/admin/addjurusan', "AdminController@addjurusan");
Route::post('/admin/deljurusan', "AdminController@deljurusan");
Route::post('/admin/upjurusan', "AdminController@upjurusan");
Route::get('/admin/listjurusan', "AdminController@listjurusan");
Route::post('/admin/detailadmin', "AdminController@detailadminjurusan");

Route::get('/admin/setakademik', "AdminController@setakademik");
Route::get('/admin/listtajar', "AdminController@listtajar");
Route::post('/admin/detailtajar', "AdminController@detailtajar");
Route::post('/admin/detailsemester', "AdminController@detailsemester");
Route::get('/admin/readtajar', "AdminController@readtajar");
Route::post('/admin/addtajar', "AdminController@addtajar");
Route::post('/admin/uptajar', "AdminController@uptajar");
Route::post('/admin/deltajar', "AdminController@deltajar");
Route::get('/admin/readsemester', "AdminController@readsemester");
Route::post('/admin/addsemester', "AdminController@addsemester");
Route::post('/admin/upsemester', "AdminController@upsemester");
Route::post('/admin/delsemester', "AdminController@delsemester");

Route::get('/admin/readadminjurusan', "AdminController@readadminjurusan");
Route::post('/admin/addadminjurusan', "AdminController@addadminjurusan");
Route::post('/admin/deladminjurusan', "AdminController@deladminjurusan");
Route::post('/admin/upadminjurusan', "AdminController@upadminjurusan");

Route::get('/admin/mahasiswa', "AdminController@mahasiswa");

Route::post('/admin/carimahasiswa', "AdminController@carimahasiswa");
Route::post('/admin/rpmahasiswa', "AdminController@resetpassword");

Route::get('/admin/keluar', "AdminController@logout");
// Dosen
Route::get('/dosen',function(){
  $css = [];
  $js = [];
  return view("dosen.pages.home")->with(["title"=>"Dashboard Dosen Perwalian","css"=>$css,"js"=>$js]);
});
Route::get('/dosen/keluar',function(){
  session()->flush();
  return redirect("/masuk")->send();
});
// Sekretariat
Route::get('/sekretariat',function(){
  $css = [];
  $js = [];
  return view("sekertariat.pages.home")->with(["title"=>"Dashboard Dosen Perwalian","css"=>$css,"js"=>$js]);
});
Route::get('/sekretariat/keluar',function(){
  session()->flush();
  return redirect("/masuk")->send();
});
// Mahasiswa
Route::get('/mhs/keluar',function(){
  session()->flush();
  return redirect("/masuk")->send();
});
// Keuangan
Route::get('/keuangan/keluar',function(){
  session()->flush();
  return redirect("/masuk")->send();
});
