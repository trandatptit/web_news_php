<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\BackController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\BanlersController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\UserController;
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

Route::get('/login', [UserController::class, 'getLogin']);
Route::post('/login', [UserController::class, 'postLogin']);
Route::get('/logout', [UserController::class, 'getLogout']);

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('admin')->group(function () {
    Route::get('/', [DashBoardController::class, 'index'])->name('user.index');
});



// Admin route group with authentication middleware
Route::middleware(['auth', 'adminLogin'])->prefix('admin')->group(function () {
    Route::get('/home', [BackController::class, 'home']);

    // Staff
    Route::prefix('staff')->group(function () {
        Route::get('profile', [BackController::class, 'staff_profile']);
        Route::post('profile', [BackController::class, 'staff_profile_post']);
        Route::get('list', [BackController::class, 'staff_list']);
        Route::get('add', [BackController::class, 'staff_add']);
        Route::post('add', [BackController::class, 'staff_add_post']);
        Route::get('edit/{id}', [BackController::class, 'staff_edit']);
        Route::post('edit/{id}', [BackController::class, 'staff_edit_post']);
        Route::get('delete/{id}', [BackController::class, 'staff_delete']);

        Route::post('filter', [BackController::class, 'staff_filter']);
    });

    //system management
    Route::get('/system', [BackController::class, 'system']);
    Route::post('/system', [BackController::class, 'system_post']);

    //page management
    Route::prefix('page')->group(function () {
        Route::get('list', [BackController::class, 'page_list']);
        Route::get('edit/{id}', [BackController::class, 'page_edit']);
        Route::post('edit/{id}', [BackController::class, 'page_edit_post']);
    });

    //category management
    Route::prefix('categories')->group(function () {
        Route::get('list', [CategoriesController::class, 'categories_list']);
        Route::get('add', [CategoriesController::class, 'categories_add']);
        Route::post('add', [CategoriesController::class, 'categories_add_post']);
        Route::get('edit/{id}', [CategoriesController::class, 'categories_edit']);
        Route::post('edit/{id}', [CategoriesController::class, 'categories_edit_post']);
        Route::get('delete/{id}', [CategoriesController::class, 'categories_delete']);
    });

    //Post management
    Route::prefix('posts')->group(function () {
        Route::get('list', [PostsController::class, 'posts_list']);
        Route::get('add', [PostsController::class, 'posts_add']);
        Route::post('add', [PostsController::class, 'posts_add_post']);
        Route::get('edit/{id}', [PostsController::class, 'posts_edit']);
        Route::post('edit/{id}', [PostsController::class, 'posts_edit_post']);
        Route::get('delete/{id}', [PostsController::class, 'posts_delete']);
        Route::get('comment/delete/{id}', [PostsController::class, 'posts_comment_delete']);
    });


    //Comment management
    Route::prefix('comments')->group(function () {
        Route::get('list', [CommentController::class, 'comments_list']);
        Route::get('delete/{id}', [CommentController::class, 'comments_delete']);

        // Route::get('add', [CommentController::class, 'comments_add']);
        // Route::post('add', [CommentController::class, 'comments_add_post']);
        // Route::get('edit/{id}', [CommentController::class, 'comments_edit']);
        // Route::post('edit/{id}', [CommentController::class, 'comments_edit_post']);
    });


    //Banler management
    Route::prefix('banlers')->group(function () {
        Route::get('list', [BanlersController::class, 'banlers_list']);
        Route::get('add', [BanlersController::class, 'banlers_add']);
        Route::post('add', [BanlersController::class, 'banlers_add_post']);
        Route::get('edit/{id}', [BanlersController::class, 'banlers_edit']);
        Route::post('edit/{id}', [BanlersController::class, 'banlers_edit_post']);
        Route::get('delete/{id}', [BanlersController::class, 'banlers_delete']);
    });
});



// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
//     Route::get('/home', 'BackController@home');

//     // Staff
//     Route::group(['prefix' => 'staff'], function() {
//         Route::get('list', 'BackController@staff_list');
//         Route::get('add', 'BackController@staff_add');
//         Route::post('add', 'BackController@staff_add_post');
//         Route::get('edit/{id}', 'BackController@staff_edit');
//         Route::post('edit/{id}', 'BackController@staff_edit_post');
//         Route::post('delete', 'BackController@staff_delete');
//     });
// });


Route::get('/', [PageController::class, 'trangchu']);
Route::get('/theloai/{id}/{tenkhongdau}.html', [PageController::class, 'theloai']);
Route::get('/baiviet/{id}/{slug}.html', [PageController::class, 'baiviet']);

Route::get('/dangnhap', [PageController::class, 'getdangnhap']);
Route::post('/dangnhap', [PageController::class, 'handleForm']);
Route::get('/dangxuat', [PageController::class, 'getdangxuat']);
Route::get('/nguoidung', [PageController::class, 'getNguoidung']);
Route::post('/nguoidung', [PageController::class, 'postNguoidung']);

Route::post('comment/{post_id}', [CommentController::class, 'postComment']);

Route::post('timkiem', [PageController::class, 'timkiem']);
