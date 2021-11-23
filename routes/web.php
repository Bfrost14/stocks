<?php

use App\Http\Controllers\Back\ArticlesController;
use App\Http\Controllers\Back\CategoriesController;
use App\Http\Controllers\Back\ConserversController;
use App\Http\Controllers\Back\CommandesController;
use App\Http\Controllers\Back\FournisseursController;
use App\Http\Controllers\Back\LivrersController;
use App\Http\Controllers\Back\SortsController;
use App\Http\Controllers\Back\StocksController;
use App\Http\Controllers\Back\UsersController;
use App\Http\Controllers\CalculsController;
use App\Http\Controllers\SortiesController;
use App\Http\Livewire\CategoriesArticlesSelect;
use App\Models\Livrer;
use App\Models\Sort;
use Illuminate\Support\Facades\Route;

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
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';
Route::get('/', 'App\Http\Controllers\HomeController@index')->middleware(['auth'])->name('home');


Route::resource('sorties', SortiesController::class);
Route::name('detail.sorties')->get('sorties/{sorty}/detail', 'App\Http\Controllers\SortiesController@detail');
Route::prefix('admin')->group(function () {
    Route::middleware('admin')->group(function () {
    Route::name('admin')->get('/', [SortsController::class, 'index']);
    Route::resource('categories', CategoriesController::class);
    Route::name('detail.catgories')->get('categories/{category}/detail', 'App\Http\Controllers\Back\CategoriesController@detail');
    Route::resource('articles', ArticlesController::class);
    Route::name('detail.articles')->get('articles/{article}/detail', 'App\Http\Controllers\Back\ArticlesController@detail');
    Route::resource('fournisseurs', FournisseursController::class);
    Route::name('detail.fournisseurs')->get('fournisseurs/{fournisseur}/detail', 'App\Http\Controllers\Back\FournisseursController@detail');
    Route::resource('livrers', LivrersController::class);
    Route::name('detail.livrers')->get('livrers/{livrer}/detail', 'App\Http\Controllers\Back\LivrersController@detail');
    Route::get('/ajout/{livrer}', [LivrersController::class, 'ajout'])->name("ajout");
    Route::resource('conservers', ConserversController::class);
    Route::resource('sorts', SortsController::class);
    Route::resource('stocks', StocksController::class);
    Route::resource('users', UsersController::class);
    Route::resource('conservers', ConserversController::class);
    Route::post('/report', [SortsController::class, 'report'])->name("report");
    Route::post('/reportCommande', [LivrersController::class, 'report'])->name("reportCommande");
    Route::name('detail')->get('users/{user}/detail', 'App\Http\Controllers\Back\UsersController@detail');

    });
});
