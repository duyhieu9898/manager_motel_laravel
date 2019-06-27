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


Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/admin'], function () {
        Route::get('/rooms', 'RoomController@create')->name('all-rooms');
        Route::get('/rooms/all', 'RoomController@getAll');
        Route::get('/rooms/{id}/edit', 'RoomController@edit')->name('room-edit');
        Route::put('/rooms/{id}', 'RoomController@update')->name('room-update');




        Route::group(['prefix' => '/users'], function () {
            /*-------------------API VUEJS CURD USER-----------------*/
            Route::view('/', 'vuejs.user');
        });
    });
});
//restful api
Route::resource('/users', 'UserController');
Route::get('/getCurrentUser', function () {
    return Auth::user()->load('roles');
});
Route::get('/getListImages/{room_id}', 'ImageController@getListImagesByRoom');
Route::post('/upload-image/{room_id}', 'ImageController@store')->name('upload-image');
Route::delete('/delete-image/{image_id?}', 'ImageController@destroy')->name('delete-image');
