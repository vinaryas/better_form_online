<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/sync1adm1n', 'FirstSync\adminSyncController@index')->name('adminSync');
Route::post('/sync1adm1n/sync1', 'FirstSync\adminSyncController@sync')->name('adminSync.sync');

Route::get('/sync2140l3', 'FirstSync\roleSyncController@index')->name('roleSync');
Route::post('/sync2140l3/sync3', 'FirstSync\roleSyncController@sync')->name('roleSync.sync');

Route::get('/sync3140l3u5314', 'FirstSync\roleUserSyncController@index')->name('roleUserSync');
Route::post('/sync3140l3u5314/sync3', 'FirstSync\roleUserSyncController@sync')->name('roleUserSync.sync');

Route::get('/sync4Perm15510n', 'FirstSync\permissionSyncController@index')->name('permissionSync');
Route::post('/sync4Perm15510n/sync2', 'FirstSync\permissionSyncController@sync')->name('permissionSync.sync');

Route::get('/sync5Perm15510n140l3', 'FirstSync\permissionRoleSyncController@index')->name('permissionRoleSync');
Route::post('/sync5Perm15510n140l3/sync4', 'FirstSync\permissionRoleSyncController@sync')->name('permissionRoleSync.sync');

Route::get('/sync4143910n', 'FirstSync\regionSyncController@index')->name('regionSync');
Route::post('/sync4143910n/sync5', 'FirstSync\regionSyncController@sync')->name('regionSync.sync');

Route::get('/sync55t0143', 'FirstSync\storeSyncController@index')->name('storeSync');
Route::post('/sync55t0143/sync5', 'FirstSync\storeSyncController@sync')->name('storeSync.sync');

Route::get('/', function () {
    return view('adminlte::auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/form_pembuatan', 'FormPembuatanController@index')->name('form_pembuatan.index');
Route::post('/form_pembuatan/store', 'FormPembuatanController@store')->name('form_pembuatan.store');

Route::get('/form_penghapusan', 'FormPenghapusanController@index')->name('form_penghapusan.index');
Route::get('/form_penghapusan/create/{id}', 'FormPenghapusanController@create')->name('form_penghapusan.create');
Route::post('/form_penghapusan/store', 'FormPenghapusanController@store')->name('form_penghapusan.store');

Route::get('/form_pemindahan', 'FormPemindahanController@index')->name('form_pemindahan.index');
Route::post('/form_pemindahan/store', 'FormPemindahanController@store')->name('form_pemindahan.store');
