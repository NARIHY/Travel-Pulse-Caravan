<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
require __DIR__.'/auth.php';


Route::prefix('/Administration')->name('Admin.')->group( function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    //Home Admin Routes
    Route::get('/Acceuil-administration', [HomeAdminController::class, 'index'])->name('Home.index');
    Route::get('/Acceuil-administration/ajouter-pub', [HomeAdminController::class, 'create'])->name('Home.create');
    Route::post('/Acceuil-administration/ajouter-pub', [HomeAdminController::class, 'store'])->name('Home.store');
    Route::get('/Acceuil-administration/{id}/editer', [HomeAdminController::class, 'edit'])->name('Home.edit');
    Route::put('/Acceuil-administration/{id}/editer', [HomeAdminController::class, 'update'])->name('Home.update');
}) ;