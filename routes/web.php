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
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    if(auth()->user())
    {
        return redirect()->route('home');
    }
    return view('auth.memberlogin');
});

Route::get('clearCache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Auth::routes();
Route::get('selfRegister', 'RegisterController@register')->name('user.register');
Route::get('register', 'RegisterController@register')->name('register')->middleware('signed');

Route::post('register', 'RegisterController@process');
Route::post('selfRegister', 'Auth\RegisterController@register')->name('auth.register');

Route::resource('orders', 'OrderController');
Route::group(["middleware" => "isSubsriber"], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('book', 'BookController');

    Route::get('bookname', 'BookController@bookName');

    Route::get('book/{id}/chapter', 'ChapterController@chapter')->name('book.chapter');

    Route::get('book/{id}/process', 'ChapterController@process')->name('chapter.process');

    Route::resource('page', 'PageController');

    Route::get('bookaudio/{id}', 'BookController@bookaudio')->name('bookaudio');

    Route::get('listenbook/{id}/{lng}/{voice}', 'BookController@listenbook')->name('listenbook');

    Route::get('delbookaudio', 'BookController@deleteAudio')->name('delbookaudio');

    Route::get('listenchapter/{id}/{lng}/{voice}', 'ChapterController@listenchapter')->name('listenchapter');

    Route::get('delchapteraudio', 'ChapterController@deleteAudio')->name('delchapteraudio');

    Route::get('pageedit/{id}', 'PageController@pageedit')->name('pageedit');

    Route::resource('chapter', 'ChapterController');

    Route::get('cheptercheck', 'ChapterController@cheptercheck')->name('cheptercheck');

    Route::post('process', 'ChapterController@process_tts')->name('process');

    Route::post('testprocess', 'ChapterController@testprocess')->name('testprocess');

    Route::get('profile', 'UserController@profile')->name('profile');

    Route::get('voicesearch', 'VoiceController@voicesearch')->name('voicesearch');

    Route::get('uservoices', 'VoiceController@uservoices')->name('uservoices');

    Route::get('userdefaultvoices', 'VoiceController@userdefaultvoices')->name('userdefaultvoices');

    Route::get('uservoicesdemo', 'VoiceController@uservoicesdemo')->name('uservoicesdemo');

    Route::get('voicegender', 'VoiceController@voicegender')->name('voicegender');
    Route::get('voicegenderdemo', 'VoiceController@voicegenderdemo')->name('voicegenderdemo');

    Route::get('membershipsearch', 'MembershipController@membershipsearch')->name('membershipsearch');

    Route::get('usersearch', 'UserController@usersearch')->name('usersearch');

    Route::get('booksearch', 'BookController@booksearch')->name('booksearch');

    Route::group(['middleware' => ['auth', 'admin']], function () {

        Route::resource('membership', 'MembershipController');

        Route::resource('voice', 'VoiceController');

        Route::get('languagesearch', 'VoiceController@languagesearch')->name('languagesearch');

        Route::resource('user', 'UserController');

    });

    //Click Bank Related Modules
    Route::get('/SubscibedPackages', 'PackagesController@SubscribedPackages')->name('SubscibedPackages');
    Route::get('/ChangeSubscriptionStatus/{subscription_id?}/{status?}', 'PackagesController@ChangeSubscriptionStatus')->name('ChangeSubscriptionStatus');
// Route::get('/PaymentForm', 'PackagesController@SubscribePackage');

// Admin side routes
    Route::get('/PackagesAdminPage', 'PackagesController@PackagesAdminPage');
    Route::post('/AddPackage', 'PackagesController@AddPackageToDb')->name('AddPackage');
    Route::get('/AddPackage', 'PackagesController@AddPackage')->name('AddPackageForm');
    Route::get('/RemovePackage', 'PackagesController@RemovePackage');
    Route::get('/UpdatePackage/{id?}', 'PackagesController@UpdatePackage')->name('UpdatePackage');
    Route::post('/UpdatePackage', 'PackagesController@UpdatePackageToDb')->name('UpdatePackage');
    Route::get('/DeletePackage/{id?}', 'PackagesController@DeletePackage')->name('DeletePackage');
    Route::get('/ViewSubscription', 'PackagesController@ViewSubscription')->name('ViewSubscribers');
    Route::get('/ChangeUserStatus/{id?}/{status?}', 'PackagesController@ChangeUserStatus')->name('ChangeUserStatus');

    Route::get('/ListPackagesForClient', 'PackagesLoginPageController@ListPackagesForClient')->name('ListPackagesForClient');
    Route::get('/signupUser/{id?}', 'PackagesLoginPageController@signupUser')->name('signupUser');
    Route::post('/signup', 'PackagesLoginPageController@createUserInDb')->name('signup');
    Route::get('/paymentForm/{userid?}/{packageid?}', 'PackagesLoginPageController@paymentForm')->name('paymentForm');
    Route::get('/testLink', 'PackagesLoginPageController@curl_request');
    Route::get('/SubscribePackage/{id?}', 'PackagesLoginPageController@SubscribePackage')->name('SubscribePackage');

});

Route::get('/packages', 'PackagesController@ListPackages')->name('Packages');
