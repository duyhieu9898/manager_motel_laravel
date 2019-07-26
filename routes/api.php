<?php

use Illuminate\Http\Request;
use App\Room;
use App\Http\Resources\RoomCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['auth:api']], function () {
    //image
    Route::get('/list-images/{room_id}', 'API\ImageController@getListImagesByRoomId');
    Route::post('/store-image', 'API\ImageController@store');
    Route::post('/upload-image/{room_id}', 'API\ImageController@saveImage')->name('upload_image');
    Route::delete('/delete-image/{image_id?}', 'API\ImageController@destroy')->name('delete_image');
    //address
    Route::get('/wards/{idDistrict}', 'API\AddressController@getWardsByDistrictId');
    Route::get('/districts/{idProvince}', 'API\AddressController@getDistrictsByProvinceId');
    Route::get('/provinces', 'API\AddressController@getProvinces');

    Route::get('/address/room/{id}', 'API\AddressController@getByRoomId');
    Route::get('/address/{id}', 'API\AddressController@getById');
    Route::post('/addresses/create', 'API\AddressController@create');
    Route::put('/address/{id}', 'API\AddressController@updateByRoomId');
    //room
    Route::get('/rooms', 'API\RoomController@index');
    Route::get('/rooms/create', 'API\RoomController@create');
    Route::post('/rooms', 'API\RoomController@store');
    Route::get('/rooms/{id}/edit', 'API\RoomController@edit')->name('room_edit');
    Route::put('/rooms/{id}', 'API\RoomController@update')->name('room_update');
    Route::delete('/rooms/{id}', 'API\RoomController@destroy');
    Route::post('/rooms/{id}/active', 'API\RoomController@active');

    // Route::get('/rooms/', function () {
    //     return new RoomCollection(Room::paginate(10));
    // });
    //booking
    Route::get('/booking', 'API\BookingController@index');
    //user
    Route::resource('/users', 'API\UserController');
    Route::resource('/categories', 'API\CategoryController');
});
