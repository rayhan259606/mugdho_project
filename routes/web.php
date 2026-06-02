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

Route::get('/clear-all', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');

        return '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>System Cache Cleared</title>
            <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
                    font-family: "Plus Jakarta Sans", sans-serif;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    min-height: 100vh;
                    color: #f8fafc;
                }
                .card {
                    background: rgba(30, 41, 59, 0.7);
                    backdrop-filter: blur(20px);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                    border-radius: 24px;
                    padding: 40px;
                    text-align: center;
                    max-width: 500px;
                    width: 90%;
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                }
                .icon {
                    width: 72px;
                    height: 72px;
                    background: linear-gradient(135deg, #22c55e, #15803d);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 24px;
                    box-shadow: 0 0 30px rgba(34, 197, 94, 0.3);
                }
                .icon svg {
                    width: 36px;
                    height: 36px;
                    fill: none;
                    stroke: white;
                    stroke-width: 3;
                    stroke-linecap: round;
                    stroke-linejoin: round;
                }
                h1 {
                    font-size: 26px;
                    font-weight: 800;
                    margin: 0 0 12px;
                    background: linear-gradient(to right, #38bdf8, #818cf8);
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                }
                p {
                    color: #94a3b8;
                    font-size: 15px;
                    margin: 0 0 30px;
                    line-height: 1.5;
                }
                .status-list {
                    text-align: left;
                    background: rgba(15, 23, 42, 0.5);
                    padding: 20px;
                    border-radius: 16px;
                    margin-bottom: 30px;
                    border: 1px solid rgba(255, 255, 255, 0.05);
                }
                .status-item {
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    font-size: 14px;
                    margin-bottom: 12px;
                }
                .status-item:last-child {
                    margin-bottom: 0;
                }
                .status-label {
                    color: #cbd5e1;
                    font-weight: 600;
                }
                .status-badge {
                    background: rgba(34, 197, 94, 0.15);
                    color: #4ade80;
                    padding: 4px 10px;
                    border-radius: 100px;
                    font-size: 12px;
                    font-weight: 700;
                }
                .btn {
                    display: inline-block;
                    background: linear-gradient(135deg, #4f46e5, #3b82f6);
                    color: white;
                    text-decoration: none;
                    padding: 14px 32px;
                    border-radius: 100px;
                    font-weight: 700;
                    font-size: 15px;
                    transition: all 0.3s ease;
                    box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
                }
                .btn:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 15px 25px rgba(79, 70, 229, 0.3);
                }
            </style>
        </head>
        <body>
            <div class="card">
                <div class="icon">
                    <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
                <h1>System Optimized!</h1>
                <p>All application configurations, routes, compiled views, and data caches have been successfully purged.</p>
                <div class="status-list">
                    <div class="status-item"><span class="status-label">Application Cache</span> <span class="status-badge">CLEARED</span></div>
                    <div class="status-item"><span class="status-label">Route Cache</span> <span class="status-badge">CLEARED</span></div>
                    <div class="status-item"><span class="status-label">Config Cache</span> <span class="status-badge">CLEARED</span></div>
                    <div class="status-item"><span class="status-label">Compiled Views</span> <span class="status-badge">CLEARED</span></div>
                    <div class="status-item"><span class="status-label">Optimizer Cache</span> <span class="status-badge">OPTIMIZED</span></div>
                </div>
                <a href="' . url('/') . '" class="btn">Back to Home</a>
            </div>
        </body>
        </html>
        ';
    } catch (\Exception $e) {
        return 'Error clearing cache: ' . $e->getMessage();
    }
});

require __DIR__.'/auth.php';
