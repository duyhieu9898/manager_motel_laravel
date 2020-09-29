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

//*===============TOOLS DEVELOPER==================*//
$router->group(['namespace' => '\Rap2hpoutre\LaravelLogViewer'], function () use ($router) {
    $router->get('logs', 'LogViewerController@index');
});
//*===============ROUTE CONTROLLER WEB==================*//
Route::get('/test-email', 'RoomController@sendEmail');
Route::view('/index2', 'index2');
Route::get('/email', function () {
    // Only verified users may enter...
    return "ok";
})->middleware('verified');


Route::get('/', 'HomeController@index')->name('index');
Route::get('/category-room/{id}', 'RoomController@getByCategoryId')->name('category_rooms');
Route::get('/detail-room/{id}', 'RoomController@show');
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/search-room', 'SearchController@searchRoom');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/getCurrentUser', function () {
        return Auth::user()->load('roles');
    });

    Route::post('/bookings/rooms/{id}', 'BookingController@booking'); //store
    Route::post('check-out/', 'BookingController@checkOut');
    Route::get('/cart', 'BookingController@cart');
    Route::get('/profile', 'UserController@index');
    Route::get('/order', 'BookingController@bookingOfUser');
    Route::get('/cancel-booking/{id}', 'BookingController@cancelBooking');
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/admin', function () {
            $token = Auth::user()->api_token;
            return redirect("http://localhost:8080/?api_token=$token");
        });
    });
    //chat
    Route::post('/messages', 'API\MessagesController@index');
    Route::post('/messages/send', 'API\MessagesController@store');
    Route::get('/notifications/me', 'NotificationController@index');
    //payment
    Route::get('return-vnpay', 'PaymentController@return');
});
//route auth
Auth::routes(['verify' => true]);
Route::get('statistical', 'API\StatisticalController@index');

//notify
Route::get('/notify', function () {
    return view('notify');
});

Route::get('/send', 'SendMessageController@index');
Route::post('/postMessage', 'SendMessageController@sendMessage')->name('postMessage');


//test
// Route::get('publish', function () {
//     LRedis::publish('message', "hello my friend");
// });
//chat
Route::resource('/users', 'API\UserController');
