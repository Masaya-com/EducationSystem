<?php

use Illuminate\Support\Facades\Route;

// ▼ User Controllers
use App\Http\Controllers\User\LoginController as UserLoginController;
use App\Http\Controllers\User\RegisterController as UserRegisterController;
use App\Http\Controllers\User\TopController as UserTopController;
use App\Http\Controllers\User\ArticleController as UserArticleController;
use App\Http\Controllers\User\CurriculumController as UserCurriculumController;
use App\Http\Controllers\User\DeliveryController as UserDeliveryController;
use App\Http\Controllers\User\ProgressController as UserProgressController;
use App\Http\Controllers\User\ProfileController as UserProfileController;

// ▼ Admin Controllers
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\TopController as AdminTopController;
use App\Http\Controllers\Admin\CurriculumController as AdminCurriculumController;
use App\Http\Controllers\Admin\DeliveryController as AdminDeliveryController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('show.login');
    Route::get('/register', [UserRegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::get('/top', [UserTopController::class, 'showTop'])->name('show.top');

    Route::get('/article/{id}', [UserArticleController::class, 'showArticle'])->name('show.article');
    Route::get('/curriculum_list', [UserCurriculumController::class, 'showCurriculumList'])->name('show.curriculum');
    Route::get('/delivery/{id}', [UserDeliveryController::class, 'showDelivery'])->name('show.delivery');
    Route::get('/progress', [UserProgressController::class, 'showProgress'])->name('show.progress');

    Route::get('/profile', [UserProfileController::class, 'showProfileForm'])->name('show.profile');
    Route::get('/password', [UserProfileController::class, 'showPasswordForm'])->name('show.password.edit');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('show.login');
    Route::get('/register', [AdminRegisterController::class, 'showRegisterForm'])->name('show.register');
    Route::get('/top', [AdminTopController::class, 'showTop'])->name('show.top');

    Route::get('/curriculum_list', [AdminCurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');
    Route::get('/curriculum_create', [AdminCurriculumController::class, 'showCurriculumCreate'])->name('show.curriculum.create');
    Route::get('/curriculum_edit/{id}', [AdminCurriculumController::class, 'showCurriculumEdit'])->name('show.curriculum.edit');

    Route::get('/delivery_edit/{id}', [AdminDeliveryController::class, 'showDeliveryEdit'])->name('show.delivery.edit');

    Route::get('/article_list', [AdminArticleController::class, 'showArticleList'])->name('show.article.list');
    Route::get('/article_create', [AdminArticleController::class, 'showArticleCreate'])->name('show.article.create');
    Route::get('/article_edit/{id}', [AdminArticleController::class, 'showArticleEdit'])->name('show.article.edit');

    Route::get('/banner_edit', [AdminBannerController::class, 'showBannerEdit'])->name('show.banner.edit');
});
