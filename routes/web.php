
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CurriculumController;
use App\Http\Controllers\Admin\AdminTopController;
use App\Http\Controllers\Admin\AdminBannerController;

// Admin Auth Controllers
use App\Http\Controllers\Admin\Auth\RegisterController as AdminRegisterController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;

// User Auth Controllers
use App\Http\Controllers\User\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\User\Auth\LoginController as UserLoginController;

// User Top
use App\Http\Controllers\User\UserTopController;


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

Route::get('/', function () {
    return view('admin.login');
});

Route::prefix('admin')->name('admin.')->group(function () {
    // 認証
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

    Route::get('/register', [AdminRegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [AdminRegisterController::class, 'register'])->name('register');

    // ログイン後（認証必須）
    Route::middleware('auth:admin')->group(function () {
        Route::get('/top', [AdminTopController::class, 'showTop'])->name('top');
        Route::delete('/banner/{banner}', [AdminBannerController::class, 'destroy'])->name('banner.destroy');
        Route::get('/banner_edit', [AdminBannerController::class, 'showBannerEdit'])->name('show.banner.edit');
        Route::post('/banner/update', [AdminBannerController::class, 'update'])->name('banner.update');
    });
});
Route::prefix('user')->name('user.')->group(function () {
    // 認証
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [UserLoginController::class, 'login'])->name('login');
    Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');

    Route::get('/register', [UserRegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [UserRegisterController::class, 'register'])->name('register');

    // ログイン後
    Route::middleware('auth:user')->group(function () {
        Route::get('/auth/top', [UserTopController::class, 'showTop'])->name('auth.top');
        Route::get('/curriculum_list', [CurriculumController::class, 'showCurriculumList'])->name('show.curriculum.list');
        Route::get('/curriculum_list/grade/{gradeId}', [CurriculumController::class, 'showCurriculumList'])->name('curriculum.byGrade');
        Route::get('/curriculum_list/grade/{gradeId}/month/{month}', [CurriculumController::class, 'showCurriculumList'])->name('curriculum.byGrade.month');
    });
});
    

    
    
    