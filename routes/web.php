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

Route::get('/sync6u53125t0123', 'FirstSync\userStoreSyncController@index')->name('userStoreSync');
Route::post('/sync6u53125t0123/sync6', 'FirstSync\userStoreSyncController@sync')->name('userStoreSync.sync');

Route::get('/sync74pl1k4s1', 'FirstSync\AplikasiSyncController@index')->name('aplikasiSync');
Route::post('/sync74pl1k4s1/sync7', 'FirstSync\AplikasiSyncController@sync')->name('aplikasiSync.sync');

Route::get('/', function () {
    return view('adminlte::auth.login');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => 'permission:dashboard'], function (){
        Route::get('/home', 'HomeController@index')->name('home');
    });

    Route::group(['middleware' => 'permission:form-pembuatan'], function (){
        Route::group(['prefix' => 'form_pembuatan'], function(){
            Route::get('', 'FormPembuatanController@index')->name('form_pembuatan.index');
            Route::post('store', 'FormPembuatanController@store')->name('form_pembuatan.store');
        });
    });

    Route::group(['middleware' => 'permission:form-penghapusan'], function (){
        Route::group(['prefix' => 'form_penghapusan'], function(){
            Route::get('', 'FormPenghapusanController@index')->name('form_penghapusan.index');
            Route::get('/create/{id}', 'FormPenghapusanController@create')->name('form_penghapusan.create');
            Route::post('/store', 'FormPenghapusanController@store')->name('form_penghapusan.store');
        });
    });

    Route::group(['middleware' => 'permission:form-pemindahan'], function (){
        Route::group(['prefix' => 'form_pemindahan'], function(){
            Route::get('', 'FormPemindahanController@index')->name('form_pemindahan.index');
            Route::post('/store', 'FormPemindahanController@store')->name('form_pemindahan.store');
         });
    });

    Route::group(['middleware' => 'permission:approval-pembuatan'], function (){
        Route::group(['prefix' => 'approval_pembuatan'], function(){
            Route::get('', 'ApprovalPembuatanController@index')->name('approval_pembuatan.index');
            Route::get('/{id}', 'ApprovalPembuatanController@create')->name('approval_pembuatan.create');
            Route::post('/store', 'ApprovalPembuatanController@approve')->name('approval_pembuatan.store');
        });
    });

    Route::group(['middleware' => 'permission:approval-penghapusan'], function (){
        Route::group(['prefix' => 'approval_penghapusan'], function(){
            Route::get('', 'ApprovalPenghapusanController@index')->name('approval_penghapusan.index');
            Route::get('/{id}', 'ApprovalPenghapusanController@detail')->name('approval_penghapusan.create');
            Route::post('/store', 'ApprovalPenghapusanController@approve')->name('approval_penghapusan.store');
        });
    });
});


