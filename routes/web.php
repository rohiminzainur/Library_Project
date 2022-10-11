<?php

use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\TransactionController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function() {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])
            ->name('dashboard');
        
            Route::resource('catalogs', CatalogController::class);
            Route::resource('authors', AuthorController::class);
            Route::resource('books', BookController::class);
            Route::resource('members', MemberController::class);
            Route::resource('publishers', PublisherController::class);
            Route::resource('transactions', TransactionController::class);
            
            Route::get('test_spatie', [TransactionController::class, 'test_spatie']);
            
            Route::get('api/authors', [AuthorController::class, 'api']);
            Route::get('api/books', [BookController::class, 'api']);
            Route::get('api/members', [MemberController::class, 'api']);
            Route::get('api/publishers', [PublisherController::class, 'api']);
            Route::get('api/transactions', [TransactionController::class, 'api']);
    });

    
    


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
// Route::get('/catalogs', [App\Http\Controllers\CatalogController::class, 'index']);
// Route::get('/authors', [App\Http\Controllers\AuthorController::class, 'index']);
// Route::get('/books', [App\Http\Controllers\BookController::class, 'index']);
// Route::get('/members', [App\Http\Controllers\MemberController::class, 'index']);
// Route::get('/publishers', [App\Http\Controllers\PublisherController::class, 'index']);