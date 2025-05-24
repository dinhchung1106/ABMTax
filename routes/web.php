<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\CourseController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CollaboratorController;
use App\Models\CompanyInfo;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('homepage');

// Admin routes
Route::get('/admin/{any}', function () {
    $companyInfo = CompanyInfo::first();
    return view('admin', ['companyInfo' => $companyInfo]);
})->where('any', '.*');

// Trang giới thiệu
Route::get('/gioi-thieu', [AboutController::class, 'index'])->name('frontend.about');
// Trang dịch vụ
Route::get('/dich-vu', [ServiceController::class, 'index'])->name('frontend.services');
Route::get('/dich-vu/{slug}', [ServiceController::class, 'show'])->name('frontend.services.show');
// Trang khóa học
Route::get('/khoa-hoc', [CourseController::class, 'index'])->name('courses');
Route::get('/khoa-hoc/{slug}', [CourseController::class, 'show'])->name('frontend.courses.show');
// Trang tin tức
Route::get('/tin-tuc', [NewsController::class, 'index'])->name('news');
Route::get('/tin-tuc/{slug}', [NewsController::class, 'show'])->name('frontend.news.show');
// Trang liên hệ
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
// Trang tuyển CTV
Route::get('/tuyen-ctv', [CollaboratorController::class, 'index'])->name('frontend.collaborator');
