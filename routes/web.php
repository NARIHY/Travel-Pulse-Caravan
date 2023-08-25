<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\CategoryController;
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
    Route::delete('/Acceuil-administration/{id}/delete', [HomeAdminController::class, 'delete'])->name('Home.delete');
    
    //flote
    Route::get('/Entreprise/nos-flote', [CategoryController::class, 'index'])->name('Entreprise.flote.index');
    Route::get('/Entreprise/nos-flote/creation', [CategoryController::class, 'create'])->name('Entreprise.flote.create');
    Route::post('/Entreprise/nos-flote/creation', [CategoryController::class, 'store'])->name('Entreprise.flote.store');
    Route::get('/Entreprise/nos-flote/{id}/mis-a-jour', [CategoryController::class, 'edit'])->name('Entreprise.flote.edit');
    Route::put('/Entreprise/nos-flote/{id}/mis-a-jour', [CategoryController::class, 'update'])->name('Entreprise.flote.update');

    //Cars
    Route::get('/Entreprise/nos-flote/voiture', [CarController::class, 'index'])->name('Entreprise.flote.car.index');
    Route::get('/Entreprise/nos-flote/voiture/Ajout-d-un-voiture', [CarController::class, 'create'])->name('Entreprise.flote.car.create');
    Route::post('/Entreprise/nos-flote/voiture/Ajout-d-un-voiture', [CarController::class, 'store'])->name('Entreprise.flote.car.store');
    Route::get('/Entreprise/nos-flote/voiture/{id}/Edition-d-un-voiture', [CarController::class, 'edit'])->name('Entreprise.flote.car.edit');
    Route::put('/Entreprise/nos-flote/voiture/{id}/Edition-d-un-voiture', [CarController::class, 'update'])->name('Entreprise.flote.car.update');
    Route::delete('/Entreprise/nos-flote/voiture/{id}/Supression-d-un-voiture', [CarController::class, 'delete'])->name('Entreprise.flote.car.delete');
    Route::get('/Entreprise/nos-flote/voiture/{id}/Vue-d-un-voiture', [CarController::class, 'view'])->name('Entreprise.flote.car.view');

    //float cars listing
    Route::get('/Entreprise/nos-flote/liste-des-voiture-par-flote', [CarListingController::class, 'index'])->name('Entreprise.flote.car.listing.flote.index');
    Route::get('/Entreprise/nos-flote/liste-des-voiture-par-flote/{id}/{category}', [CarListingController::class, 'listing'])->name('Entreprise.flote.car.listing.flote.listing');
}) ;