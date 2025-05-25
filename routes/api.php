<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\CompanyInfoController;
use App\Http\Controllers\API\RolePermissionController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\LessonController as AdminLessonController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    Route::put('/me', [AuthController::class, 'updateMe']);
    // Route mẫu cho admin
    Route::middleware('admin')->get('/admin/dashboard', function() {
        return response()->json(['message' => 'Welcome admin!']);
    });
});

// Route fallback cho admin SPA
Route::get('/admin/{any}', function () {
    // Fetch Company Info to pass to the admin view
    $companyInfo = \App\Models\CompanyInfo::first(); // Assuming you fetch the first record
    return view('admin', compact('companyInfo'));
})->where('any', '.*');

Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // User routes with detailed permissions
    Route::get('/users', [UserController::class, 'index'])->middleware('permission:view_users,sanctum');
    Route::post('/users', [UserController::class, 'store'])->middleware('permission:create_user,sanctum');
    Route::get('/users/{user}', [UserController::class, 'show'])->middleware('permission:view_users,sanctum');
    Route::put('/users/{user}', [UserController::class, 'update'])->middleware('permission:edit_user,sanctum');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->middleware('permission:delete_user,sanctum');

    // Service routes with detailed permissions
    Route::get('/services', [ServiceController::class, 'index'])->middleware('permission:view_services,sanctum');
    Route::post('/services', [ServiceController::class, 'store'])->middleware('permission:create_service,sanctum');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->middleware('permission:view_services,sanctum');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->middleware('permission:edit_service,sanctum');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->middleware('permission:delete_service,sanctum');

    // News routes with detailed permissions
    Route::get('/news', [NewsController::class, 'index'])->middleware('permission:view_posts,sanctum');
    Route::post('/news', [NewsController::class, 'store'])->middleware('permission:create_post,sanctum');
    Route::get('/news/{news}', [NewsController::class, 'show'])->middleware('permission:view_posts,sanctum');
    Route::put('/news/{news}', [NewsController::class, 'update'])->middleware('permission:edit_post,sanctum');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->middleware('permission:delete_news,sanctum');
    Route::post('/news/upload-image', [NewsController::class, 'uploadImage'])->middleware('permission:create_post,sanctum');

    // Course routes with detailed permissions
    Route::get('/courses', [CourseController::class, 'index'])->middleware('permission:view_courses,sanctum');
    Route::post('/courses', [CourseController::class, 'store'])->middleware('permission:create_course,sanctum');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->middleware('permission:view_courses,sanctum');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->middleware('permission:edit_course,sanctum');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->middleware('permission:delete_course,sanctum');

    // Lesson routes with detailed permissions
    Route::prefix('courses/{course}')->group(function () {
        Route::get('lessons', [LessonController::class, 'index'])->middleware('permission:view_lessons,sanctum');
        Route::post('lessons', [LessonController::class, 'store'])->middleware('permission:create_lesson,sanctum');
        Route::put('lessons/{lesson}', [LessonController::class, 'update'])->middleware('permission:edit_lesson,sanctum');
        Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->middleware('permission:delete_lesson,sanctum');
        Route::post('lessons/reorder', [LessonController::class, 'reorder'])->middleware('permission:edit_lesson,sanctum');
    });

    // Company Info routes with detailed permissions
    Route::get('/company-info', [CompanyInfoController::class, 'index'])->middleware('permission:view_company_info,sanctum');
    Route::put('/company-info', [CompanyInfoController::class, 'update'])->middleware('permission:edit_company_info,sanctum');

    // Role and Permission management routes - usually only Super Admin or specific roles
    // Assuming a 'manage_roles_and_permissions' general permission for this section
    Route::middleware('permission:manage_roles_and_permissions,sanctum')->group(function () {
        Route::get('/roles', [RolePermissionController::class, 'getRoles']);
        Route::post('/roles', [RolePermissionController::class, 'store']);
        Route::put('/roles/{role}', [RolePermissionController::class, 'update']);
        Route::delete('/roles/{role}', [RolePermissionController::class, 'destroy']);
    });

    // Get current user's permissions - no special permission required
    Route::get('/permissions', [RolePermissionController::class, 'getPermissions']);

    // Contact routes with permissions
    Route::get('/contacts', [ContactController::class, 'index'])->middleware('permission:view_contacts,sanctum');
    Route::get('/contacts/{contact}', [ContactController::class, 'show'])->middleware('permission:view_contacts,sanctum');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->middleware('permission:delete_contacts,sanctum');

    // Reports route (if any)
    // Route::get('/reports', [ReportController::class, 'index'])->middleware('permission:view_report,sanctum');

    // Slider Banner routes with detailed permissions
    Route::get('/slider-banners', [\App\Http\Controllers\API\SliderBannerController::class, 'index'])->middleware('permission:view_slider_banners,sanctum');
    Route::post('/slider-banners', [\App\Http\Controllers\API\SliderBannerController::class, 'store'])->middleware('permission:create_slider_banner,sanctum');
    // Route::get('/slider-banners/{slider_banner}', [\App\Http\Controllers\API\SliderBannerController::class, 'show'])->middleware('permission:view_slider_banners,sanctum'); // Show route might not be strictly necessary for a simple list/form
    Route::put('/slider-banners/{slider_banner}', [\App\Http\Controllers\API\SliderBannerController::class, 'update'])->middleware('permission:edit_slider_banner,sanctum');
    Route::delete('/slider-banners/{slider_banner}', [\App\Http\Controllers\API\SliderBannerController::class, 'destroy'])->middleware('permission:delete_slider_banner,sanctum');

    // Category routes with detailed permissions
    Route::get('/categories', [CategoryController::class, 'index'])->middleware('permission:view_categories,sanctum');
    Route::post('/categories', [CategoryController::class, 'store'])->middleware('permission:create_category,sanctum');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->middleware('permission:view_categories,sanctum');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->middleware('permission:edit_category,sanctum');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->middleware('permission:delete_category,sanctum');

    // Tag routes with detailed permissions
    Route::get('/tags', [TagController::class, 'index'])->middleware('permission:view_tags,sanctum');
    Route::post('/tags', [TagController::class, 'store'])->middleware('permission:create_tag,sanctum');
    Route::get('/tags/{tag}', [TagController::class, 'show'])->middleware('permission:view_tags,sanctum');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->middleware('permission:edit_tag,sanctum');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->middleware('permission:delete_tag,sanctum');

    // Session Routes
    Route::get('/courses/{course}/sessions', [SessionController::class, 'index'])->middleware('permission:view_courses,sanctum');
    Route::post('/courses/{course}/sessions', [SessionController::class, 'store'])->middleware('permission:edit_course,sanctum');
    Route::put('/sessions/{session}', [SessionController::class, 'update'])->middleware('permission:edit_course,sanctum');
    Route::delete('/sessions/{session}', [SessionController::class, 'destroy'])->middleware('permission:edit_course,sanctum');

    // Lesson Routes
    Route::get('/sessions/{session}/lessons', [AdminLessonController::class, 'index'])->middleware('permission:view_courses,sanctum');
    Route::post('/sessions/{session}/lessons', [AdminLessonController::class, 'store'])->middleware('permission:edit_course,sanctum');
    Route::put('/lessons/{lesson}', [AdminLessonController::class, 'update'])->middleware('permission:edit_course,sanctum');
    Route::delete('/lessons/{lesson}', [AdminLessonController::class, 'destroy'])->middleware('permission:edit_course,sanctum');
});
