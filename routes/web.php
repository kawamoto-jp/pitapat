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

Route::get('/', function () {
    return view('top');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//管理側
Route::group(['middleware' => ['auth.admin']], function () {

  //管理側トップ
  Route::get('/admin', 'App\Http\Controllers\admin\AdminTopController@show');
  //ログアウト実行
  Route::post('/admin/logout', 'App\Http\Controllers\admin\AdminLogoutController@logout'); 
  //ユーザー一覧
  Route::get('/admin/user_list', 'App\Http\Controllers\admin\ManageUserController@showUserList');
  //ユーザー詳細
  Route::get('/admin/user/{id}', 'App\Http\Controllers\admin\ManageUserController@showUserDetail');

});

//管理側ログイン
Route::get('/admin/login', 'App\Http\Controllers\admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'App\Http\Controllers\admin\AdminLoginController@login');