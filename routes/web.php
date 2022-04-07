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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/change/password', 'Auth\LoginController@showChangePassword')->name('change.password');
Route::post('/change/password/store', 'Auth\LoginController@changePasswordStore')->name('change.password.store');
Route::get('/send/otp', 'Auth\LoginController@showSendOtp')->name('send.otp');
Route::post('/send/otp/store', 'Auth\LoginController@sendOtp')->name('send.otp.store');
Route::get('/forget/password', 'Auth\LoginController@showForgetPassword')->name('forget.password');
Route::post('/forget/password/store', 'Auth\LoginController@forgetPassword')->name('forget.password.store');

Route::get('/register/sponsor', 'Auth\LoginController@showRegisterSponsorForm')->name('register.sponsor');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@Login')->name('login');
Route::post('/register/sponsor/store', 'Auth\LoginController@registerSponsorForm')->name('register.sponsor.store');
Route::get('/send/otp/register', 'Auth\LoginController@showSendOtpRegister')->name('send.otp.register');
Route::post('/send/otp/register/store', 'Auth\LoginController@sendOtpRegister')->name('send.otp.register.store');
Route::get('/linking',function(){
    \Illuminate\Support\Facades\Artisan::call('storage:link');
});
Route::get('/time',function(){
   dd(\Carbon\Carbon::now());
});
Route::get('/clear/cache',function(){
    \Illuminate\Support\Facades\Artisan::call('view:clear');
});

Route::middleware('auth')->group(function () {
    Route::get('/home', 'UserController@index')->name('home');
    Route::get('/send/now', 'HomeController@sendNow')->name('send.now');
    Route::get('/settings', 'HomeController@settings')->name('settings');
    Route::post('/settings/update', 'HomeController@settings_update')->name('settings.update');

    Route::get('/profile', 'UserController@profile')->name('profile.show');
    Route::post('/profile', 'UserController@update_profile')->name('profile.update');

    Route::get('/orphan/manage', 'UserController@orphan_manage')->name('orphan.manage');
    Route::get('/orphan/add', 'UserController@orphan_add')->name('orphan.add');
    Route::post('/orphan/store', 'UserController@orphan_store')->name('orphan.store');
    Route::post('/orphan/import', 'UserController@orphan_import')->name('orphan.import');
    Route::post('/orphan/update', 'UserController@orphan_update')->name('orphan.update');
    Route::get('/orphan/delete/{id}', 'UserController@orphan_destroy')->name('orphan.delete');
    Route::get('/sponsor/orphan/delete/{sponsor}/{orphan}', 'UserController@sponsor_orphan_destroy')->name('sponsor.orphan.delete');
    Route::get('/orphan/report', 'UserController@orphan_report')->name('orphan.report');


    Route::get('/sponsor/manage', 'UserController@sponsor_manage')->name('sponsor.manage');
    Route::get('/sponsor/add', 'UserController@sponsor_add')->name('sponsor.add');
    Route::get('/sponsor/orphan/join', 'UserController@sponsor_add')->name('sponsor.add');
    Route::post('/sponsor/store', 'UserController@sponsor_store')->name('sponsor.store');
    Route::post('/sponsor/update', 'UserController@sponsor_update')->name('sponsor.update');
    Route::get('/sponsor/delete/{id}', 'UserController@sponsor_destroy')->name('sponsor.delete');
    Route::post('/sponsor/delete/multi', 'UserController@sponsor_destroy_multi')->name('sponsor.delete.multi');
    Route::get('/sponsor/report', 'UserController@sponsor_report')->name('sponsor.report');
    Route::get('/sponsor/pay', 'UserController@sponsor_pay')->name('sponsor.pay');
    Route::post('/sponsor/pay/store', 'UserController@sponsor_pay_store')->name('sponsor.pay.store');
    Route::post('/sponsor/import', 'UserController@sponsor_import')->name('sponsor.import');

    Route::get('/sponsor/orphan/join', 'UserController@sponsor_orphan')->name('orphan.sponsor.join');
    Route::post('/sponsor/orphan/store', 'UserController@sponsor_orphan_store')->name('orphan.sponsor.store');

    Route::get('/messages', 'HomeController@messages')->name('messages');
    Route::post('/messages/store', 'HomeController@messages_store')->name('message.store');
    Route::post('/message/send/pay/store', 'HomeController@messages_send_pay_store')->name('message.send.pay.store');
    Route::get('/send/message/manually', 'UserController@send_message_manually')->name('send.message.manually');
    Route::post('uploadPostImages', 'PostController@uploadPostImages')->name('uploadPostImages');
    Route::post('uploadPostImages?responseType=json', 'PostController@uploadPostImages')->name('uploadPostImages');

    Route::resources([
        'post' => 'PostController',
    ]);
    Route::post('post/{post}/update','PostController@update')->name('post.update');
    Route::get('post/delete/{post}','PostController@destroy')->name('post.destroy');
    Route::get('post/publish/{post}','PostController@publish')->name('post.publish');
    Route::get('post/show/{post}','PostController@show')->name('post.show');

    Route::get('post/reserve/{post}','PostController@reserve')->name('post.reserve');
    Route::get('post/pay/{post}','PostController@pay')->name('post.pay');
    Route::get('post/cancel/{post}','PostController@cancel')->name('post.cancel');

    Route::post('/logout',function(){
        Auth::logout();
        return redirect('/login');
    })->name('logout');

});


