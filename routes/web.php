<?php

use App\Http\Controllers\Api\Auth\SocialLoginController;
use App\Http\Controllers\Web\Frontend\AffiliateController;
use App\Http\Controllers\Web\Frontend\ContactController;
use App\Http\Controllers\Web\Frontend\HomeController;
use App\Http\Controllers\Web\Frontend\PageController;
use App\Http\Controllers\Web\Frontend\SubscriberController;
use App\Http\Controllers\Web\Frontend\LeadController as FrontendLeadController;
use App\Http\Controllers\Web\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/',[HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product.details');
Route::get('/course/{id}', [HomeController::class, 'course'])->name('course.details');
Route::get('/service/{id}', [HomeController::class, 'service'])->name('service.details');

// Module Landing Pages
Route::get('/msm-course', [HomeController::class, 'msmCourse'])->name('module.msm');
Route::get('/gadgets', [HomeController::class, 'gadgets'])->name('module.gadgets');
Route::get('/digital-products', [HomeController::class, 'digital'])->name('module.digital');
Route::get('/antique-collection', [HomeController::class, 'antique'])->name('module.antique');
Route::get('/business-services', [HomeController::class, 'services'])->name('module.services');

Route::get('/affiliate/{slug}',[AffiliateController::class, 'store'])->name('store');

Route::get('/post',[HomeController::class, 'posts'])->name('post.index');
Route::get('/post/show/{slug}',[HomeController::class, 'post'])->name('post.show');

//Social login test routes
Route::get('social-login/{provider}',[SocialLoginController::class,'RedirectToProvider'])->name('social.login');
Route::get('social-login/{provider}/callback',[SocialLoginController::class, 'HandleProviderCallback']);

Route::post('subscriber/store',[SubscriberController::class, 'store'])->name('subscriber.data.store');

Route::post('contact/store',[ContactController::class, 'store'])->name('contact.store');

Route::post('course/enroll', [FrontendLeadController::class, 'enroll'])->name('course.enroll');
Route::post('product/order', [FrontendLeadController::class, 'order'])->name('product.order');
Route::post('service/request', [FrontendLeadController::class, 'serviceRequest'])->name('service.request');

Route::controller(NotificationController::class)->prefix('notification')->name('notification.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('read/single/{id}', 'readSingle')->name('read.single');
    Route::POST('read/all', 'readAll')->name('read.all');
})->middleware('auth');

Route::get('/page/{slug}',[PageController::class, 'index']);

require __DIR__.'/auth.php';
