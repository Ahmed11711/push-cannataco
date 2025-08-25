<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AboutController,
    AchievementController,
    ArticleController,
    AuthClientController,
    GalleryController,
    MessageController,
    QuoteController,
    ServiceController,
    ContactController,
    SettingController,
    SliderController,
    TestimonialController,
    WhyController,
    HowController,
    MerchantController,
    FaqsController,
    TeamController,
    OrderController,
    TrackController
};
use App\Http\Resources\MerchantResource;

// -----------------------------
// OAuth Authentication
// -----------------------------
Route::get('auth/{provider}/redirect', [MerchantController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [MerchantController::class, 'handleProviderCallback']);

// -----------------------------
// Merchant Routes
// -----------------------------
Route::prefix('merchant')->group(function () {
    // Public merchant routes
    Route::post('login', [MerchantController::class, 'login']);
    Route::post('register', [MerchantController::class, 'register']);

    // Protected merchant routes
    Route::middleware(['auth:sanctum', 'auth:merchant'])->group(function () {
        Route::post('orders', [OrderController::class, 'store']);
        Route::get('orders/{id}', [OrderController::class, 'show']);

        Route::get('conversation', [MessageController::class, 'getConversation']);
        Route::post('send-message', [MessageController::class, 'sendMessage']);

        Route::get('me', fn(Request $request) => new MerchantResource($request->user()));
        Route::post('logout', [MerchantController::class, 'logout']);
    });
});

// -----------------------------
// Orders
// -----------------------------
Route::get('tracks', [TrackController::class, 'index']);
Route::get('orders/by-serial/{serial_number}', [OrderController::class, 'findBySerial']);

// -----------------------------
// Public API Resources
// -----------------------------
Route::get('about', [AboutController::class, 'index']);

Route::apiResource('service', ServiceController::class)->only(['index', 'show']);
Route::apiResource('article', ArticleController::class)->only(['index', 'show']);

Route::post('contact', [ContactController::class, 'store']);
Route::post('quote', [QuoteController::class, 'store']);

Route::get('setting', [SettingController::class, 'index']);
Route::apiResource('slider', SliderController::class)->only(['index', 'show']);

Route::get('testimonial', [TestimonialController::class, 'index']);
Route::get('why', [WhyController::class, 'index']);
Route::get('how', [HowController::class, 'index']);
Route::get('faqs', [FaqsController::class, 'index']);
Route::get('team', [TeamController::class, 'index']);
Route::get('gallery', [GalleryController::class, 'index']);
Route::get('achievements', [AchievementController::class, 'index']);
