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

Route::get('/',"HomeController@index");
Route::get('/login',"HomeController@login");
Route::post('/login',"HomeController@login_aksi");
Route::get('/hasil/{id}',"HomeController@hasil");
Route::get('/register',"HomeController@register");
Route::post('/register',"HomeController@register_aksi");
Route::get('/logout',"HomeController@logout");
//Admin
Route::get('/admin',"AdminController@index");
Route::get('/admin/verifikasi/{id}',"AdminController@verifikasi");

Route::get('/admin/juri',"AdminController@juri");
Route::get('/admin/juriadd',"AdminController@juriadd");
Route::post('/admin/juriadd',"AdminController@juriadd_aksi");
Route::get('/admin/juriedit/{id}',"AdminController@juriedit");
Route::post('/admin/juriedit/{id}',"AdminController@juriedit_aksi");
Route::get('/admin/jurihapus/{id}',"AdminController@jurihapus");

Route::get('/admin/kelas',"AdminController@kelas");
Route::get('/admin/kelasadd',"AdminController@kelasadd");
Route::post('/admin/kelasadd',"AdminController@kelasadd_aksi");
Route::get('/admin/kelasedit/{id}',"AdminController@kelasedit");
Route::post('/admin/kelasedit/{id}',"AdminController@kelasedit_aksi");
Route::get('/admin/kelashapus/{id}',"AdminController@kelashapus");

Route::get('/admin/event',"AdminController@event");
Route::get('/admin/eventadd',"AdminController@eventadd");
Route::post('/admin/eventadd',"AdminController@eventadd_aksi");
Route::get('/admin/eventedit/{id}',"AdminController@eventedit");
Route::post('/admin/eventedit/{id}',"AdminController@eventedit_aksi");
Route::get('/admin/eventhapus/{id}',"AdminController@eventhapus");

Route::get('/admin/eventdetail/{id}',"AdminController@eventdetail");
Route::get('/admin/eventdetail/{id}/juri',"AdminController@eventdetailjuri");
Route::get('/admin/eventdetail/{id}/kriteria',"AdminController@eventdetailkriteria");
Route::get('/admin/eventdetail/{id}/kriteria/{del}/del',"AdminController@eventdetailkriteria_del");
Route::get('/admin/eventdetail/{id}/juri/{del}/del',"AdminController@eventdetailjuri_del");
Route::post('/admin/eventdetail/{id}/juri',"AdminController@eventdetailjuri_aksi");
Route::post('/admin/eventdetail/{id}/kriteria',"AdminController@eventdetailkriteria_aksi");
Route::get('/admin/eventdetail/{id}/hasil',"AdminController@eventdetailhasil");
//Juri
Route::get('/juri',"JuriController@index");
Route::get('/juri/penilaian',"JuriController@penilaian");
Route::get('/juri/penilaian/{id}',"JuriController@penilaian_detail");
Route::post('/juri/penilaian/{id}',"JuriController@penilaian_detail_aksi");
//Peserta
Route::get('/peserta',"PesertaController@index");
Route::post('/peserta',"PesertaController@index_aksi");
Route::get('/peserta/print/{id}',"PesertaController@print");
Route::get('/peserta/event',"PesertaController@event");
Route::get('/peserta/event/{id}',"PesertaController@event_detail");
Route::get('/peserta/event/{id}/register',"PesertaController@eventregister");
