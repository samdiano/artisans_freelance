<?php

use App\User;

use App\Category;

use Illuminate\Support\Facades\Input;


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

//Payment IPN

Route::get('/ipnbtc', 'PaymentController@ipnBchain')->name('ipn.bchain');
Route::get('/ipnblockbtc', 'PaymentController@blockIpnBtc')->name('ipn.block.btc');
Route::get('/ipnblocklite', 'PaymentController@blockIpnLite')->name('ipn.block.lite');
Route::get('/ipnblockdog', 'PaymentController@blockIpnDog')->name('ipn.block.dog');
Route::post('/ipnpaypal', 'PaymentController@ipnpaypal')->name('ipn.paypal');
Route::post('/ipnperfect', 'PaymentController@ipnperfect')->name('ipn.perfect');
Route::post('/ipnstripe', 'PaymentController@ipnstripe')->name('ipn.stripe');
Route::post('/ipnskrill', 'PaymentController@skrillIPN')->name('ipn.skrill');
Route::post('/ipncoinpaybtc', 'PaymentController@ipnCoinPayBtc')->name('ipn.coinPay.btc');
Route::post('/ipncoinpayeth', 'PaymentController@ipnCoinPayEth')->name('ipn.coinPay.eth');
Route::post('/ipncoinpaybch', 'PaymentController@ipnCoinPayBch')->name('ipn.coinPay.bch');
Route::post('/ipncoinpaydash', 'PaymentController@ipnCoinPayDash')->name('ipn.coinPay.dash');
Route::post('/ipncoinpaydoge', 'PaymentController@ipnCoinPayDoge')->name('ipn.coinPay.doge');
Route::post('/ipncoinpayltc', 'PaymentController@ipnCoinPayLtc')->name('ipn.coinPay.ltc');
Route::post('/ipncoin', 'PaymentController@ipnCoin')->name('ipn.coinpay');
Route::post('/ipncoingate', 'PaymentController@ipnCoinGate')->name('ipn.coingate');


Route::get('/', 'FrontendController@index')->name('homepage');
Route::get('/menu/{slug}', 'FrontendController@menu');
Route::get('/about-us', 'FrontendController@about');
Route::get('/faqs', 'FrontendController@faqs');
Route::get('/click-add/{id}', 'FrontendController@clickadd');
Route::get('/contact-us', 'FrontendController@contactUs');
Route::post('/contact-us', ['uses' => 'FrontendController@contactSubmit', 'as' => 'contact-submit']);
Route::post('/subscribe', 'FrontendController@subscribe')->name('subscribe');

Auth::routes();
//Search route
Route::any('/search',function(){
    $q = Input::get( 'q' );
    $user = User::where('category_id','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('search')->withDetails($user)->withQuery ( $q );
    else return view ('search')->withMessage('No Details found. Try to search again !');
});

Route::get('/search', 'HomeController@search');

Route::group(['prefix' => 'user'], function () {

    Route::get('authorization', 'HomeController@authCheck')->name('user.authorization');

    Route::post('verification', 'HomeController@sendVcode')->name('user.send-vcode');
    Route::post('smsVerify', 'HomeController@smsVerify')->name('user.sms-verify');

    Route::post('verify-email', 'HomeController@sendEmailVcode')->name('user.send-emailVcode');
    Route::post('postEmailVerify', 'HomeController@postEmailVerify')->name('user.email-verify');


    Route::middleware(['CheckStatus'])->group(function () {
        Route::get('/home', 'HomeController@index')->name('home');
        Route::get('/deposit', ['uses' => 'HomeController@deposit', 'as' => 'deposit']);
        Route::post('/deposit-data-insert', 'HomeController@depositDataInsert')->name('deposit.data-insert');
        Route::get('/deposit-preview', 'HomeController@depositPreview')->name('user.deposit.preview');
        Route::post('/deposit-confirm', 'PaymentController@depositConfirm')->name('deposit.confirm');

        Route::get('/withdraw-money', 'HomeController@withdrawMoney')->name('withdraw.money');
        Route::post('/withdraw-preview', 'HomeController@requestPreview')->name('withdraw.preview');
        Route::post('/withdraw-submit', 'HomeController@requestSubmit')->name('withdraw.submit');

        Route::get('/transaction-log', 'HomeController@activity')->name('user.trx');
        Route::get('/deposit-log', 'HomeController@depositLog')->name('user.depositLog');
        Route::get('/withdraw-log', 'HomeController@withdrawLog')->name('user.withdrawLog');

        Route::get('change-password', ['as' => 'user.change-password', 'uses' => 'HomeController@changePassword']);
        Route::post('change-password', ['as' => 'user.change-password', 'uses' => 'HomeController@submitPassword']);

        Route::get('dashboard', ['as' => 'edit-profile', 'uses' => 'HomeController@editProfile']);
        Route::post('dashboard', ['as' => 'edit-profile', 'uses' => 'HomeController@submitProfile']);

        Route::get('edit-resume', ['as' => 'edit.resume', 'uses' => 'HomeController@editResume']);
        Route::post('edit-resume', ['as' => 'update.resume', 'uses' => 'HomeController@updateResume']);

        Route::get('add-job', ['as' => 'add.job', 'uses' => 'HomeController@addJob']);
        Route::post('add-job', ['as' => 'store.job', 'uses' => 'HomeController@storeJob']);
        Route::get('manage-job', ['as' => 'manage.job', 'uses' => 'HomeController@manageJob']);
        Route::get('edit-job/{id}/{slug}', ['as' => 'edit.job', 'uses' => 'HomeController@editJob']);
        Route::put('update-job', ['as' => 'update.job', 'uses' => 'HomeController@updateJob']);
        Route::post('delete-job', ['as' => 'job.delete', 'uses' => 'HomeController@deleteJob']);

        Route::get('job-details/{id}/{slug}', ['as' => 'details.job', 'uses' => 'HomeController@detailsJob']);
        Route::get('biography/{id}/{slug}', ['as' => 'biography', 'uses' => 'HomeController@biography']);
        Route::post('mail-author', ['as' => 'mail.author', 'uses' => 'HomeController@mailAuthor']);
        Route::post('bit-project-job', ['as' => 'bit.job', 'uses' => 'HomeController@bitJob']);
        Route::post('bit-job-home', ['as' => 'bit.job.home', 'uses' => 'HomeController@bitJobHomePage']);


        Route::get('bid-project/{id}/{slug}', ['as' => 'bid.Userlist', 'uses' => 'HomeController@bidProjectUserlist']);

        Route::post('assign-job', ['as' => 'assign.job', 'uses' => 'HomeController@assignJob']);
        Route::get('awarded-list', ['as' => 'assign.list', 'uses' => 'HomeController@assignList']);
        Route::get('milestone/{id}/{slug}', ['as' => 'get.mileStone', 'uses' => 'HomeController@viewMileStone']);
        Route::post('create-milestone', ['as' => 'create.mileStone', 'uses' => 'HomeController@createMileStone']);
        Route::post('remove-assign-list', ['as' => 'remove.assign.list', 'uses' => 'HomeController@removeAssignList']);

        Route::get('report-log/{id}', ['as' => 'report.log', 'uses' => 'HomeController@reportLog']);
        Route::post('send-reports', ['as' => 'send.reports', 'uses' => 'HomeController@sendReports']);

        Route::get('report-log-author/{id}', ['as' => 'report.log.author', 'uses' => 'HomeController@reportLogAuthor']);

        Route::get('my-job', ['as' => 'activeJobList', 'uses' => 'HomeController@activeJobList']);

        Route::get('milestone-list/{id}/{slug}', ['as' => 'projectMileStoneList', 'uses' => 'HomeController@projectMileStoneList']);
        Route::post('cancelClientJob', ['as' => 'cancelClientJob', 'uses' => 'HomeController@cancelClientJob']);
        Route::post('release-amount', ['as' => 'release.amount', 'uses' => 'HomeController@releaseAmount']);
        Route::post('reject-amount', ['as' => 'reject.amount', 'uses' => 'HomeController@rejectAmount']);

        Route::post('user-report', ['as' => 'user.report', 'uses' => 'HomeController@userReport']);


        Route::get('chat/{id}', 'ChatsController@index')->name('chat.user');
        Route::post('get-chat', 'ChatsController@getChat')->name('get.chat');
        Route::post('messages', 'ChatsController@sendMessage')->name('store.message');
        Route::get('messages', ['as' => 'user.messages', 'uses' => 'ChatsController@messageslist']);

    });
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'AdminLoginController@index')->name('admin.loginForm');
    Route::post('/', 'AdminLoginController@authenticate')->name('admin.login');
});


Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {


    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');

    Route::get('categories', 'DashboardController@categories')->name('admin.category');
    Route::post('categories', 'DashboardController@categoryStore')->name('category.save');
    Route::put('/category/update/{id}', 'DashboardController@categoryUpdate')->name('category.update');

    Route::get('reports', 'DashboardController@reports')->name('admin.reports');
    Route::get('reports/{id}', 'DashboardController@reportsAllView')->name('reports.view');
    Route::post('accept-milestone', 'DashboardController@milestoneAccepted')->name('milestone.accepted');
    Route::post('store-report', 'DashboardController@storeReport')->name('store.report');

    Route::get('projects-requests', 'DashboardController@projects')->name('admin.projects');
    Route::post('projects-search', ['as' => 'search.projects', 'uses' => 'DashboardController@projectSearch']);
    Route::post('all-approve-projects', ['as' => 'search.allApprove.projects', 'uses' => 'DashboardController@allApproveProjectSearch']);
    Route::put('project/approve/{id}', 'DashboardController@projectApprove')->name('project.approve');
    Route::put('project/reject/{id}', 'DashboardController@projectReject')->name('project.reject');

    Route::get('projects-approved', 'DashboardController@approvedAllProjects')->name('admin.approved.projects');


    //Gateway
    Route::get('/gateway', 'GatewayController@show')->name('gateway');
    Route::post('/gateway', 'GatewayController@update')->name('update.gateway');

    //Deposit
    Route::get('/deposits', 'DepositController@index')->name('deposits');
    Route::get('/deposits/requests', 'DepositController@requests')->name('deposits.requests');
    Route::put('/deposit/approve/{id}', 'DepositController@approve')->name('deposit.approve');
    Route::get('/deposit/{deposit}/delete', 'DepositController@destroy')->name('deposit.destroy');

    //withdraw
    Route::get('/withdraw', 'WithdrawController@index')->name('withdraw');
    Route::post('/withdraw', 'WithdrawController@store')->name('add.withdraw.method');
    Route::post('/withdraw-update', 'WithdrawController@withdrawUpdateSettings')->name('update.wsettings');
    Route::get('/withdraw/requests', 'WithdrawController@requests')->name('withdraw.requests');
    Route::put('/withdraw/approve/{id}', 'WithdrawController@approve')->name('withdraw.approve');
    Route::post('/withdraw/refund', 'WithdrawController@refundAmount')->name('withdraw.refund');


    //Email Template
    Route::get('/template', 'EtemplateController@index')->name('email.template');
    Route::post('/template-update', 'EtemplateController@update')->name('template.update');
    //Sms Api
    Route::get('/sms-api', 'EtemplateController@smsApi')->name('sms.api');
    Route::post('/sms-update', 'EtemplateController@smsUpdate')->name('sms.update');


    // General Settings
    Route::get('/general-settings', 'GeneralSettingController@GenSetting')->name('admin.GenSetting');
    Route::post('/general-settings', 'GeneralSettingController@UpdateGenSetting')->name('admin.UpdateGenSetting');
    Route::get('/change-password', 'GeneralSettingController@changePassword')->name('admin.changePass');
    Route::post('/change-password', 'GeneralSettingController@updatePassword')->name('admin.changePass');
    Route::get('/profile', 'GeneralSettingController@profile')->name('admin.profile');
    Route::post('/profile', 'GeneralSettingController@updateProfile')->name('admin.profile');


    //User Management
    Route::get('users', ['as' => 'users', 'uses' => 'GeneralSettingController@users']);
    Route::post('user-search', ['as' => 'search.users', 'uses' => 'GeneralSettingController@userSearch']);
    Route::get('user/{user}', ['as' => 'user.single', 'uses' => 'GeneralSettingController@singleUser']);
    Route::put('user/pass-change/{user}', ['as' => 'user.passchange', 'uses' => 'GeneralSettingController@userPasschange']);
    Route::put('user/status/{user}', ['as' => 'user.status', 'uses' => 'GeneralSettingController@statupdate']);
    Route::get('mail/{user}', ['as' => 'user.email', 'uses' => 'GeneralSettingController@userEmail']);
    Route::post('/sendmail', ['as' => 'send.email', 'uses' => 'GeneralSettingController@sendemail']);
    Route::get('/user-login-history/{id}', ['as' => 'user.login.history', 'uses' => 'GeneralSettingController@loginLogsByUsers']);
    Route::get('/user-balance/{id}', ['as' => 'user.balance', 'uses' => 'GeneralSettingController@ManageBalanceByUsers']);
    Route::post('/user-balance', ['as' => 'user.balance.update', 'uses' => 'GeneralSettingController@saveBalanceByUsers']);
    Route::get('/user-banned', ['as' => 'user.ban', 'uses' => 'GeneralSettingController@banusers']);
    Route::get('login-logs/{user?}', ['as' => 'user.login-logs', 'uses' => 'GeneralSettingController@loginLogs']);

    Route::get('/user-transaction/{id}', ['as' => 'user.trans', 'uses' => 'GeneralSettingController@userTrans']);
    Route::get('/user-deposit/{id}', ['as' => 'user.deposit', 'uses' => 'GeneralSettingController@userDeposit']);
    Route::get('/user-withdraw/{id}', ['as' => 'user.withdraw', 'uses' => 'GeneralSettingController@userWithdraw']);

    Route::get('/subscribers', 'DashboardController@manageSubscribers')->name('manage.subscribers');
    Route::post('/update-subscribers', 'DashboardController@updateSubscriber')->name('update.subscriber');
    Route::get('/send-email', 'DashboardController@sendMail')->name('send.mail.subscriber');
    Route::post('/send-email', 'DashboardController@sendMailsubscriber')->name('send.email.subscriber');

    //Contact Setting
    Route::get('contact-setting', ['as' => 'contact-setting', 'uses' => 'WebSettingController@getContact']);
    Route::put('contact-setting/{id}', ['as' => 'contact-setting-update', 'uses' => 'WebSettingController@putContactSetting']);

    Route::get('manage-logo', ['as' => 'manage-logo', 'uses' => 'WebSettingController@manageLogo']);
    Route::post('manage-logo', ['as' => 'manage-logo', 'uses' => 'WebSettingController@updateLogo']);

    Route::get('manage-footer', ['as' => 'manage-footer', 'uses' => 'WebSettingController@manageFooter']);
    Route::put('manage-footer', ['as' => 'manage-footer-update', 'uses' => 'WebSettingController@updateFooter']);


    Route::get('manage-social', ['as' => 'manage-social', 'uses' => 'WebSettingController@manageSocial']);
    Route::post('manage-social', ['as' => 'manage-social', 'uses' => 'WebSettingController@storeSocial']);
    Route::get('manage-social/{product_id?}', ['as' => 'social-edit', 'uses' => 'WebSettingController@editSocial']);
    Route::put('manage-social/{product_id?}', ['as' => 'social-edit', 'uses' => 'WebSettingController@updateSocial']);
    Route::delete('manage-social/{product_id?}', ['as' => 'social-delete', 'uses' => 'WebSettingController@deleteSocial']);

    Route::get('menu-create', ['as' => 'menu-create', 'uses' => 'WebSettingController@createMenu']);
    Route::post('menu-create', ['as' => 'menu-create', 'uses' => 'WebSettingController@storeMenu']);
    Route::get('menu-control', ['as' => 'menu-control', 'uses' => 'WebSettingController@manageMenu']);
    Route::get('menu-edit/{id}', ['as' => 'menu-edit', 'uses' => 'WebSettingController@editMenu']);
    Route::post('menu-update/{id}', ['as' => 'menu-update', 'uses' => 'WebSettingController@updateMenu']);
    Route::delete('menu-delete', ['as' => 'menu-delete', 'uses' => 'WebSettingController@deleteMenu']);

    Route::get('how-it-works', ['as' => 'service-control', 'uses' => 'WebSettingController@manageService']);
    Route::post('how-it-works', ['as' => 'service-heading', 'uses' => 'WebSettingController@serviceHeading']);
    Route::get('how-it-works/{id}', ['as' => 'service-edit', 'uses' => 'WebSettingController@editService']);
    Route::post('how-it-works/{id}', ['as' => 'service-update', 'uses' => 'WebSettingController@updateService']);

    Route::get('featured', ['as' => 'featured', 'uses' => 'WebSettingController@manageFeatured']);
    Route::post('featured', ['as' => 'featured', 'uses' => 'WebSettingController@updateBasicFeatured']);

    Route::get('featured/create', ['as' => 'featured.create', 'uses' => 'WebSettingController@featuredCreate']);
    Route::post('featured/create', ['as' => 'featured.store', 'uses' => 'WebSettingController@storeFeatured']);
    Route::get('featured/{id}', ['as' => 'featured.edit', 'uses' => 'WebSettingController@featuredEdit']);
    Route::post('featured/{id}', ['as' => 'featured.update', 'uses' => 'WebSettingController@updateFeatured']);
    Route::post('featured-delete', ['as' => 'featured.delete', 'uses' => 'WebSettingController@deleteFeatured']);

    Route::get('manage-breadcrumb', ['as' => 'manage-breadcrumb', 'uses' => 'WebSettingController@mangeBreadcrumb']);
    Route::post('manage-breadcrumb', ['as' => 'manage-breadcrumb', 'uses' => 'WebSettingController@updateBreadcrumb']);

    Route::get('manage-about', ['as' => 'manage-about', 'uses' => 'WebSettingController@manageAbout']);
    Route::post('manage-about', ['as' => 'manage-about', 'uses' => 'WebSettingController@updateAbout']);

    Route::get('short-about', ['as' => 'short.about', 'uses' => 'WebSettingController@shortAbout']);
    Route::post('short-about', ['as' => 'short.about', 'uses' => 'WebSettingController@updateShortAbout']);


    Route::get('faqs-create', ['as' => 'faqs-create', 'uses' => 'WebSettingController@createFaqs']);
    Route::post('faqs-create', ['as' => 'faqs-create', 'uses' => 'WebSettingController@storeFaqs']);
    Route::get('faqs-all', ['as' => 'faqs-all', 'uses' => 'WebSettingController@allFaqs']);
    Route::get('faqs-edit/{id}', ['as' => 'faqs-edit', 'uses' => 'WebSettingController@editFaqs']);
    Route::put('faqs-edit/{id}', ['as' => 'faqs-update', 'uses' => 'WebSettingController@updateFaqs']);
    Route::delete('faqs-delete', ['as' => 'faqs-delete', 'uses' => 'WebSettingController@deleteFaqs']);


    //    Testimonial Controller
    Route::get('testimonial', 'TestimonialController@index')->name('admin.testimonial');
    Route::get('testimonial/create', 'TestimonialController@create')->name('testimonial.create');
    Route::post('testimonial/create', 'TestimonialController@store')->name('testimonial.store');
    Route::delete('testimonial/delete', 'TestimonialController@destroy')->name('testimonial.delete');
    Route::get('testimonial/edit/{id}', 'TestimonialController@edit')->name('testimonial.edit');
    Route::post('testimonial-update', 'TestimonialController@updatePost')->name('testimonial.update');

    /* Manage Slider*/
    Route::get('manage-slider', ['as' => 'manage-slider', 'uses' => 'WebSettingController@manageSlider']);
    Route::post('manage-slider', ['as' => 'manage-slider', 'uses' => 'WebSettingController@storeSlider']);
    Route::delete('slider-delete', ['as' => 'slider-delete', 'uses' => 'WebSettingController@deleteSlider']);


    Route::get('/logout', 'AdminController@logout')->name('admin.logout');
});


/*============== User Password Reset Route list ===========================*/
Route::get('user-password/reset', 'User\ForgotPasswordController@showLinkRequestForm')->name('user.password.request');
Route::post('user-password/email', 'User\ForgotPasswordController@sendResetLinkEmail')->name('user.password.email');
Route::get('user-password/reset/{token}', 'User\ResetPasswordController@showResetForm')->name('user.password.reset');
Route::post('user-password/reset', 'User\ResetPasswordController@reset');




