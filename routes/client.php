<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ApiController;

Route::prefix('')->name('client.')->controller(PageController::class)->group(function () {
    Route::get('', 'index')->name('index');
    Route::get('{slug}', 'story')->name('story');
    Route::get('doc-truyen/{slug_story}/{slug_chapter}', 'chapter')->name('chapter');
    Route::get('danh-muc/{slug}', 'category')->name('category');
    Route::get('tim-kiem/v1', 'search')->name('search');
    Route::get('trang-chu', 'index')->name('home');

    // Story type pages
    Route::get('danh-sach/truyen-hot', 'hot_stories')->name('hot_stories');
    Route::get('danh-sach/truyen-moi', 'latest_stories')->name('latest_stories');
    Route::get('danh-sach/truyen-full', 'completed_stories')->name('completed_stories');
});

Route::prefix('api')->name('client.')->controller(ApiController::class)->group(function () {
    Route::get('get_story', 'get_story')->name('get_story');
    Route::get('get_hot_story', 'get_hot_story')->name('get_hot_story');
    Route::get('get_completed_story', 'get_completed_story')->name('get_completed_story');
    Route::get('get_story/{slug}', 'get_story_by_slug')->name('get_story_by_slug');
    Route::get('get_category', 'get_category')->name('get_category');
    Route::get('get_category/{slug}', 'get_category_by_slug')->name('get_category_by_slug');
    Route::get('get_search', 'get_search')->name('get_search');
});

