<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController;

Route::get("/admin", function () {
    return redirect()->route("admin.dashboard");
})->name("admin");

Route::get("/admin/dashboard", [DashboardController::class, 'index'])
    ->name("admin.dashboard")
    ->middleware('admin');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    // Quản lý thành viên
    Route::prefix('user')->name('user.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::post('/update/{id}', 'update')->name('update');
        Route::get('/show/{id}', 'show')->name('show');
        Route::post('/destroy/{id}', 'destroy')->name('destroy');
        Route::post('/update-status', 'updateStatus')->name('update_status');
    });

    // Quản lý danh mục
    Route::prefix('category')->name('category.')->controller(CategoryController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('update-status', 'update_status')->name('update_status');
        Route::post('destroy/{id}', 'destroy')->name('destroy');
    });

    // Quản lý truyện
    Route::prefix('story')->name('story.')->controller(StoryController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('update-status', 'update_status')->name('update_status');
        Route::post('update-status-story', 'update_status_story')->name('update_status_story');
        Route::post('update-feature', 'update_feature')->name('update_feature');
        Route::post('destroy/{id}', 'destroy')->name('destroy');

        // chapter
        Route::get('chapter/{story_id}', 'index_chapter')->name('index_chapter');
        Route::get('create-chapter/{id}', 'create_chapter')->name('create_chapter');
        Route::post('store-chapter/{id}', 'store_chapter')->name('store_chapter');
        Route::get('edit-chapter/{story_id}/{id}', 'edit_chapter')->name('edit_chapter');
        Route::post('update-chapter/{story_id}/{id}', 'update_chapter')->name('update_chapter');
        Route::post('update-chapter-order/{story_id}', 'update_chapter_order')->name('update_chapter_order');
        Route::post('destroy-chapter/{story_id}/{id}', 'destroy_chapter')->name('destroy_chapter');
    });

    // setting
    Route::prefix('setting')->name('setting.')->controller(SettingController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('update', 'update')->name('update');
    });
});
