<?php

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
use Illuminate\Support\Facades\Auth;

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
    Route::get('/address/{id}', 'API\AddressController@getById');
    Route::post('/addresses/create', 'API\AddressController@create');
    Route::put('/address/{id}', 'API\AddressController@updateById');

    //room
    Route::get('/rooms', 'API\RoomController@index');
    Route::get('/rooms/create', 'API\RoomController@create');
    Route::post('/rooms', 'API\RoomController@store');
    Route::get('/rooms/{id}/edit', 'API\RoomController@edit')->name('room_edit');
    Route::put('/rooms/{id}', 'API\RoomController@update')->name('room_update');
    Route::delete('/rooms/{id}', 'API\RoomController@destroy');
    Route::post('/rooms/{id}/active', 'API\RoomController@active');
    Route::post('rooms/updatePeople', 'API\RoomController@updatePeopleInRoom');

    //booking
    Route::get('/bookings', 'API\BookingController@index');
    Route::get('/bookings/{id}', 'API\BookingController@show');
    Route::post('/bookings/{id}/status-update', 'API\BookingController@updateStatus');
    Route::delete('/bookings/{id}', 'API\BookingController@destroy');
    Route::get('/users/bookings', 'API\UserController@bookings');

    //category
    Route::resource('/categories', 'API\CategoryController');

    //convenient
    Route::resource('/convenients', 'API\ConvenientController');

    //user
    Route::get('/getCurrentUser', function () {
        return Auth::user()->load('roles');
    });
    Route::resource('/users', 'API\UserController');

    //statistical
    Route::get('statistical', 'API\StatisticalController@index');
    Route::get('/getListUserOtherMe', 'API\UsersController@getListUserOtherMe');
    Route::post('/messages', 'API\MessagesController@index');
    Route::post('/messages/send', 'API\MessagesController@store');
    //
    Route::post('/sent-notification', 'API\NotificationController@sent');
});
