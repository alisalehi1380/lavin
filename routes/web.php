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

Route::prefix('lottery')->name('lottery.')->group(function () {
    Route::get('/', 'LotteryController@index')->name('index');
    Route::post('/start', 'LotteryController@start')->name('start');
});


Route::prefix('portfolios')->name('portfolios.')->group(function () {
    Route::get('/','PortfoilioController@index')->name('index');
    Route::get('/{slug}','PortfoilioController@show')->name('show');
});


Route::prefix('articles')->name('articles.')->group(function () {
    Route::get('/blog', 'ArticleController@blog')->name('blog');
    Route::get('/show/{slug}', 'ArticleController@show')->name('show');
    Route::post('{article}/commnt', 'CommentController@store')->name('comments.store');
});

Route::prefix('shop')->name('shop.')->group(function(){

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', 'CartController@index')->name('index');
        Route::get('{product}/add2cart', 'CartController@add2cart')->name('add2cart');
        Route::get('{cart}/remove', 'CartController@remove')->name('remove');
        Route::delete('/clear', 'CartController@clear')->name('clear');
        Route::post('/update', 'CartController@update')->name('update');
        Route::post('/discount', 'CartController@discount')->name('discount');
        Route::post('/order', 'CartController@order')->name('order');
    });

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', 'ProductController@index')->name('index');
        Route::get('/show/{slug}', 'ProductController@show')->name('show');
        Route::post('{product}/reviwe', 'ProductController@reviwe')->name('reviwe');
    });

});

Route::prefix('services')->name('services.')->group(function(){

    Route::get('/', 'ServiceController@index')->name('index');
    Route::get('/{slug}/show', 'ServiceController@show')->name('show');
    Route::POST('/{service}/reserve/{detail}', 'ServiceController@reserve')->name('reserve');
});




Route::get('/','MainController@home')->name('home');
Route::get('/', 'HomeController@index')->name('index');
Route::get('/search','HomeController@search')->name('search');
Route::post('/register', 'RegisterController@register')->name('register');
Route::post('/login', 'AuthController@login')->name('login');
Route::get('/logout','AuthController@logout')->name('logout');
Route::get('/forgotPass', 'AuthController@forgotPass')->name('forgotPass');
Route::post('/recoveyPass', 'AuthController@recoveyPass')->name('recoveyPass');
Route::get('/changePass/{token}', 'AuthController@changePass')->name('changePass');
Route::PATCH('/changePassword/{token}', 'AuthController@changePassword')->name('changePassword');
Route::get('/about','HomeController@about')->name('about');
Route::get('/contact','HomeController@contact')->name('contact');
Route::post('/message','HomeController@message')->name('message');
Route::get('{doctor}/doctor','HomeController@doctor')->name('doctor');
Route::get('/faq','HomeController@faq')->name('faq');

Route::get('/fetchcities', 'FetchController@fetchcities')->name('fetchcities');
Route::get('/fetchparts', 'FetchController@fetchparts')->name('fetchparts');

Route::get('/gallery','PageController@gallery')->name('gallery');

Route::post('/subcat','ProductController@subcat')->name('subcat');



//حساب کاربری
Route::group(['middleware' => 'auth'], function () {

    Route::prefix('account')->namespace('CRM')->name('account.')->group(function () {

        Route::get('/dashboard', 'DashboardController@dashboard')->name('dashboard');

        Route::prefix('profile')->name('profile.')->group(function () {

             Route::get('/', 'ProfileController@index')->name('index');
             Route::patch('/updatepro', 'ProfileController@updatepro')->name('updatepro');
             Route::patch('/updatepass', 'ProfileController@updatepass')->name('updatepass');
             Route::patch('/updateaddress', 'ProfileController@updateaddress')->name('updateaddress');
             Route::patch('/updatebank', 'ProfileController@updatebank')->name('updatebank');
             Route::patch('/updateinfo', 'ProfileController@updateinfo')->name('updateinfo');

        });

        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', 'NotificationController@index')->name('index');
            Route::get('{notification}/show', 'NotificationController@show')->name('show');
       });

       Route::prefix('tickets')->name('tickets')->group(function () {

            Route::get('/', 'TicketController@index')->name('.index');
            Route::get('/create', 'TicketController@create')->name('.create');
            Route::POST('/store', 'TicketController@store')->name('.store');
            Route::POST('/ticketmessage/{ticket}', 'TicketController@ticketmessage')->name('.ticketmessage');
            Route::patch('/{ticket}', 'TicketController@update')->name('.update');
            Route::get('{ticket}/show', 'TicketController@show')->name('.show');
            Route::delete('delete/{ticket}', 'TicketController@destroy')->name('.delete');
            Route::get('/getaudience/{id}', 'TicketController@getaudience')->name('.getaudience');
        });

        Route::prefix('reserves')->name('reserves.')->group(function () {
            Route::get('/', 'ReserveController@index')->name('index');
            Route::get('{reserve}/payment', 'ReserveController@payment')->name('payment');
            Route::POST('{reserve}/discount', 'ReserveController@discount')->name('discount');
            Route::POST('{payment}/pay', 'ReserveController@pay')->name('pay');
            Route::POST('{reserve}/reviwe', 'ReserveController@reviwe')->name('reviwe');
        });

        Route::get('/', 'BuyController@index')->name('buy');

        Route::prefix('numbers')->name('numbers.')->group(function () {
            Route::get('/','NumberController@create')->name('create');
            Route::post('/','NumberController@store')->name('store');
        });


        Route::prefix('discount')->name('discount.')->group(function () {
            Route::get('/', 'DiscountController@index')->name('index');
        });

    });

    //payment
    Route::prefix('/payments')->name('payments.')->group(function(){
        Route::get('/pay', 'PaymentController@pay')->name('pay');
        Route::get('/verify', 'PaymentController@verification')->name('verify');
        Route::get('/result', 'PaymentController@result')->name('result');
    });

});




