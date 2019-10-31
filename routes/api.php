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

Route::post('/admin/login', 'API\UserController@login');


Route::group(['middleware' => ['auth:api']], function () {
    //image
    Route::get('/images/room/{room_id}', 'API\ImageController@getListImagesByRoomId');
    Route::post('/images', 'API\ImageController@store');
    Route::post('/upload-image/{room_id}', 'API\ImageController@saveImage')->name('upload_image');
    Route::delete('/images/{image_id?}', 'API\ImageController@destroy')->name('delete_image');

    //address
    Route::get('/wards/{idDistrict}', 'API\AddressController@getWardsByDistrictId');
    Route::get('/districts/{idProvince}', 'API\AddressController@getDistrictsByProvinceId');
    Route::get('/provinces', 'API\AddressController@getProvinces');
    Route::get('/addresses/{id}', 'API\AddressController@getById');
    Route::post('/addresses/create', 'API\AddressController@create');
    Route::put('/addresses/{id}', 'API\AddressController@updateById');

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

    //convenience
    Route::resource('/conveniences', 'API\ConvenienceController');

    //user
    Route::get('/getCurrentUser', function () {
        return Auth::user()->load('roles');
    });
    Route::resource('/users', 'API\UserController');

    //statistical
    Route::get('/statistical', 'API\StatisticalController@index');
    Route::get('/getListUserOtherMe', 'API\UserController@getListUserOtherMe');

    //
    Route::post('/send-notification', 'API\NotificationController@sent');
    Route::get('/search-users/{value}', 'API\UserController@fuzzySearch');
    //message
    Route::post('/messages', 'API\MessagesController@index');
    Route::post('/messages/send', 'API\MessagesController@store');

    // basic information
    Route::get('/basic-information', 'API\BasicInformationController@index');
    Route::put('/basic-information/{id}', 'API\BasicInformationController@update');
});

