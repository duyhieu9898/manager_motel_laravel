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

//*===============TOOLS DEVELOPER==================*//
$router->group(['namespace' => '\Rap2hpoutre\LaravelLogViewer'], function () use ($router) {
    $router->get('logs', 'LogViewerController@index');
});
//*===============ROUTE CONTROLL WEB==================*//
Route::get('/test-email', 'RoomController@sendEmail');
Auth::routes(['verify' => true]);

Route::get('/profile', function () {
    // Only verified users may enter...
    return "ok";
})->middleware('verified');

Route::get('/', 'RoomController@latest')->name('index');
Route::get('/category-room/{id}', 'RoomController@category')->name('category_rooms');
Route::get('/detail-room/{id}', 'RoomController@show');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
//*===============ROUTE CONTROLL ADMIN==================*//

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => '/admin'], function () {


        Route::group(['prefix' => '/users'], function () {
            /*-------------------API VUEJS CURD USER-----------------*/
            Route::view('/', 'vuejs.user');
        });
    });
});
//!restful api
Route::resource('/users', 'UserController');
Route::get('/getCurrentUser', function () {
    return Auth::user()->load('roles');
});
Route::group(['middleware' => ['admin']], function () {
    //image
    Route::post('/api/store-image', 'ImageController@store');
    Route::get('/api/list-images/{room_id}', 'ImageController@getListImagesByRoomId');
    Route::post('/api/upload-image/{room_id}', 'ImageController@saveImage')->name('upload_image');
    Route::delete('/api/delete-image/{image_id?}', 'ImageController@destroy')->name('delete_image');
    //address
    Route::get('/api/wards/{idDistrict}', 'AddressController@getWardsByDistrict');
    Route::get('/api/districts/{idProvince}', 'AddressController@getDistrictsByProvince');
    Route::get('/api/provinces', 'AddressController@getProvinces');

    Route::get('/api/address/{id}', 'AddressController@getAddressByRoom');
    Route::put('/api/address/{id}', 'AddressController@updateAddressByRoom');
    Route::post('/api/addresses/create', 'AddressController@create');
    //room
    Route::get('/api/rooms', 'RoomController@index');
    Route::get('/api/rooms/{id}/edit', 'RoomController@edit')->name('room_edit');
    Route::get('/api/rooms/create', 'RoomController@create');
    Route::post('/api/rooms', 'RoomController@store');
});

Route::put('api/rooms/{id}', 'RoomController@update')->name('room_update');
//*===============ROUTE FOR SPA-ADMIN==================*//
Route::group(['middleware' => ['admin']], function () {
    Route::get('/app', function () {
        return view('admin.app');
    });
    Route::group(['prefix' => '/app'], function () {
        Route::any('/{any}', function () {
            return view('admin.app');
        })->where('any', '.*');
    });
});
