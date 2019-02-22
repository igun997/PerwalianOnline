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
//Jurusan
Route::get('/jurusan', "JurusanController@index");
Route::get('/jurusan/profile', "JurusanController@profile");
Route::post('/jurusan/upprofile', "JurusanController@upprofile");
//Kurikulum
Route::get('/jurusan/kurikulum', "JurusanController@kurikulum");
Route::get('/jurusan/readkurikulum', "JurusanController@readkurikulum");
Route::post('/jurusan/addkurikulum', "JurusanController@addkurikulum");
Route::post('/jurusan/delkurikulum', "JurusanController@delkurikulum");
Route::get('/jurusan/aturkurikulum/{id}/{run}', "JurusanController@aturkurikulum");
Route::post('/jurusan/addmatkul', "JurusanController@addmatkul");
Route::post('/jurusan/upmatkul', "JurusanController@upmatkul");
Route::post('/jurusan/delmatkul', "JurusanController@delmatkul");
Route::get('/jurusan/listsemester', "JurusanController@listsemester");
Route::post('/jurusan/detailmatkul', "JurusanController@detailmatkul");
//MHS
Route::get('/jurusan/mahasiswa', "JurusanController@mahasiswa");
Route::post('/jurusan/carimahasiswa', "JurusanController@carimahasiswa");
//Data Dosen
Route::get('/jurusan/dosen', "JurusanController@dosen");
Route::get('/jurusan/readdosen', "JurusanController@readdosen");
Route::post('/jurusan/adddosen', "JurusanController@adddosen");
Route::post('/jurusan/updosen', "JurusanController@updosen");
Route::post('/jurusan/deldosen', "JurusanController@deldosen");
Route::post('/jurusan/detaildosen', "JurusanController@detaildosen");
// Data Sekretariat
Route::get('/jurusan/sekretariat', "JurusanController@sekretariat");
Route::get('/jurusan/readsekretariat', "JurusanController@readsekretariat");
Route::post('/jurusan/addsekretariat', "JurusanController@addsekretariat");
Route::post('/jurusan/upsekretariat', "JurusanController@upsekretariat");
Route::post('/jurusan/delsekretariat', "JurusanController@delsekretariat");
Route::post('/jurusan/detailsekretariat', "JurusanController@detailsekretariat");
//Kelas Angkatan
Route::get('/jurusan/kelasangkatan', "JurusanController@kelasangkatan");
Route::get('/jurusan/readkelasangkatan', "JurusanController@readkelasangkatan");
Route::post('/jurusan/addkelasangkatan', "JurusanController@addkelasangkatan");
Route::post('/jurusan/upkelasangkatan', "JurusanController@upkelasangkatan");
Route::post('/jurusan/delkelasangkatan', "JurusanController@delkelasangkatan");
Route::post('/jurusan/detailkelasangkatan', "JurusanController@detailkelasangkatan");
Route::get('/jurusan/listdosen', "JurusanController@listdosen");
Route::get('/jurusan/listtajar', "JurusanController@listtajar");
//Kelas Mapel
Route::get('/jurusan/kelasmapel', "JurusanController@kelasmapel");
Route::get('/jurusan/readruangan', "JurusanController@readruangan");
Route::post('/jurusan/addruangan', "JurusanController@addruangan");
Route::post('/jurusan/upruangan', "JurusanController@upruangan");
Route::post('/jurusan/delruangan', "JurusanController@delruangan");
Route::get('/jurusan/listruangan', "JurusanController@listruangan");
//Extra
Route::post('/jurusan/detailruang', "JurusanController@detailruang");
Route::post('/jurusan/detailkelasmapel', "JurusanController@detailkelasmapel");
//Sub Kelas
Route::get('/jurusan/readkelasmapel', "JurusanController@readkelasmapel");
Route::post('/jurusan/addkelasmapel', "JurusanController@addkelasmapel");
Route::post('/jurusan/upkelasmapel', "JurusanController@upkelasmapel");
Route::post('/jurusan/delkelasmapel', "JurusanController@delkelasmapel");
Route::get('/jurusan/listmatkul', "JurusanController@listmatkul");
Route::get('/jurusan/keluar', "JurusanController@logout");
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
