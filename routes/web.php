<?php
use Illuminate\Http\Request;
use App\User;
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


$router->group(['namespace' => '\Rap2hpoutre\LaravelLogViewer'], function () use ($router) {
    $router->get('logs', 'LogViewerController@index');
});

Route::get('/test-email', 'RoomController@sendEmail');
Auth::routes(['verify' => true]);

Route::get('/profile', function () {
    // Only verified users may enter...
    return "ok";
})->middleware('verified');

Route::get('/', 'RoomController@latest')->name('index');
Route::get('/detail-room/{id}', 'RoomController@show');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//admin
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/admin'], function () {
        Route::get('/rooms', 'RoomController@create');
        Route::get('/rooms/all', 'RoomController@getAll')->name('all-rooms');
        Route::get('/rooms/{id}/edit', 'RoomController@edit')->name('edit-room');
        Route::put('/rooms/{id}', 'RoomController@update')->name('update-room');
    });
    Route::group(['prefix' => 'users-admin'], function () {
        /*-------------------API VUEJS CURD USER-----------------*/
        Route::view('/', 'vuejs.user');
    });
});
//
Route::get('/getCurrentUser', function () {
    dd(Auth::user());
    return Auth::user()->get();
});
//
Route::put('/upload-image', 'ImageController@store')->name('upload-image');
Route::delete('/delete-image', 'ImageController@destroy')->name('delete-image');
