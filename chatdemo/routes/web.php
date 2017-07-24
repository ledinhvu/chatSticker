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

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();


Route::middleware(['auth', 'admin' ])->group(function () {
    Route::get('/home', ['as' => 'home.index', 'uses' => 'Backend\HomeController@index']);

    Route::resource('rooms', 'Backend\RoomsController');

    Route::resource('messages', 'Backend\MessagesController');

    Route::resource('users', 'Backend\UserController');

    Route::resource('images', 'Backend\ImagesController');
});

Route::get('/', 'Frontend\HomeChatController@index');
Route::post('registerUser', 'Frontend\RegisterController@store')->name('register_user');

Route::get('loginChat', 'Frontend\LoginChatController@index')->name('loginChat');
Route::post('submitLogin', 'Frontend\LoginChatController@login')->name('submitLogin');

Route::middleware(['user'])->group(function () {
    Route::get('choiceRoom', 'Frontend\LoginChatController@choice')->name('choiceRoom');
    Route::get('room/{id}', 'Frontend\LoginChatController@joinroom')->name('joinroom');
    Route::get('choosemem/{id}', 'Frontend\LoginChatController@choosemem')->name('choosemem');
    Route::get('addmem', 'Frontend\LoginChatController@addmem')->name('addmem');
    Route::get('/sendmessage', 'Frontend\SocketController@sendMessage');
    Route::get('writemessage', 'Frontend\SocketController@writemessage');
});


