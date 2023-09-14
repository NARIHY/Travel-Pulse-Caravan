<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarInformationController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicityController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TripController;
use App\Models\CarInformation;
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
    //return pdf download
    Route::get('/Entreprise/nos-flote/voiture/{id}/pdf', [CarController::class, 'generatePDF'])->name('Entreprise.flote.car.generatePDF');


    //float cars listing
    Route::get('/Entreprise/nos-flote/liste-des-voiture-par-flote', [CarListingController::class, 'index'])->name('Entreprise.flote.car.listing.flote.index');
    Route::get('/Entreprise/nos-flote/liste-des-voiture-par-flote/{id}/{category}', [CarListingController::class, 'listing'])->name('Entreprise.flote.car.listing.flote.listing');

    //CAr Information routes
    $routesCarInformation = "Entreprise.flote.car.carInformation.";
    Route::get('/Entreprise/nos-flote/voiture/information', [CarInformationController::class, 'index'])->name($routesCarInformation.'index');
    Route::get('/Entreprise/nos-flote/voiture/information/ajouter-information-pour-un-voiture', [CarInformationController::class, 'create'])->name($routesCarInformation.'create');
    Route::post('/Entreprise/nos-flote/voiture/information/ajouter-information-pour-un-voiture', [CarInformationController::class, 'store'])->name($routesCarInformation.'store');


    //trip
    $trip = "Entreprise.trip.";
    Route::get('/Entreprise/gestion-de-trajet/liste-des-villes', [TravelController::class, 'index'])->name($trip.'travel.index');
    Route::get('/Entreprise/gestion-de-trajet/liste-des-villes/ajout-de-ville', [TravelController::class, 'create'])->name($trip.'travel.create');
    Route::post('/Entreprise/gestion-de-trajet/liste-des-villes/ajout-de-ville', [TravelController::class, 'store'])->name($trip.'travel.store');
    //trip reservation
    Route::get('/Entreprise/gestion-de-trajet/liste-des-trajet-planifier', [TripController::class, 'index'])->name($trip.'planified.index');
    Route::get('/Entreprise/gestion-de-trajet/liste-des-trajet-planifier/trajet-creation', [TripController::class, 'create'])->name($trip.'planified.create');
    Route::post('/Entreprise/gestion-de-trajet/liste-des-trajet-planifier/trajet-creation', [TripController::class, 'store'])->name($trip.'planified.store');
    Route::get('/Entreprise/gestion-de-trajet/liste-des-trajet-planifier/trajet-creation/{id}/edition', [TripController::class, 'edit'])->name($trip.'planified.edit');
    Route::put('/Entreprise/gestion-de-trajet/liste-des-trajet-planifier/trajet-creation/{id}/edition', [TripController::class, 'update'])->name($trip.'planified.update');
    Route::delete('/Entreprise/gestion-de-trajet/liste-des-trajet-planifier/trajet-creation/{id}/suppréssion', [TripController::class, 'delete'])->name($trip.'planified.delete');
    //Admin reservation
    Route::get('Entreprise/gestion-de-trajet/reservation', [ReservationController::class, 'index'])->name($trip.'reservation.index');
    //Passenger
    Route::get('Entreprise/gestion-de-trajet/reservation/passager', [ReservationController::class, 'passenger'])->name($trip.'reservation.create.passenger');
    Route::post('Entreprise/gestion-de-trajet/reservation/passager', [ReservationController::class, 'passenger_add'])->name($trip.'reservation.create.passenger_add');
    //Start city and arrivals choice
    Route::get('Entreprise/gestion-de-trajet/reservation/passager/{passenger_id}/{purcount}/lieu-depart-et-arriver', [ReservationController::class, 'destination'])->name($trip.'reservation.passenger.city');
    Route::post('Entreprise/gestion-de-trajet/reservation/passager/{passenger_id}/{purcount}/lieu-depart-et-arriver', [ReservationController::class, 'destination_save'])->name($trip.'reservation.passenger.city.store');
    Route::get('Entreprise/gestion-de-trajet/reservation/passager/{passenger_id}/{purcount}/{depart}-{arrivals}', [ReservationController::class, 'reservate'])->name($trip.'reservation.passenger.city.reserve');
    Route::get('Entreprise/gestion-de-trajet/reservation/passager/{passenger_id}/{purcount}/{depart}-{arrivals}/{tripId}', [ReservationController::class, 'payement'])->name($trip.'reservation.passenger.city.payement');
    Route::post('Entreprise/gestion-de-trajet/reservation/passager/{passenger_id}/{purcount}/{depart}-{arrivals}/{tripId}', [ReservationController::class, 'success'])->name($trip.'reservation.passenger.city.success');

    //payement

    //final result
    Route::get('Entreprise/gestion-de-trajet/reservation/passager/{purcount}/{passenger_id}-{tripId}/reservation', [ReservationController::class, 'finale'])->name($trip.'reservation.passenger.city.finale');



    //export pdf
    Route::get('Entreprise/gestion-de-trajet/reservation/passager/pdf/{purcount}/{passenger_id}/{tripId}/reservation/55', [ReservationController::class, 'pdf'])->name('pdf.export');
    //Route for car information
    Route::prefix('/Information')->name('Information.')->group( function() {
        Route::get('/Liste-des-informations-publier', [InformationController::class, 'listing'])->name('listing');
        Route::get('/Ajouter-une-information',[InformationController::class,'create'])->name('create');
        Route::post('/Ajouter-une-information',[InformationController::class,'store'])->name('store');
        //Route for edition
        Route::get('/{id}/edition-d-une-information', [InformationController::class, 'edit'])->name('edit');
        Route::put('/{id}/edition-d-une-information', [InformationController::class, 'update'])->name('update');
        //deleting information
        Route::delete('/{id}/Suprimer-une-information', [InformationController::class, 'delete'])->name('delete');
    });

    //Route for publicity
    Route::prefix('/Publicite')->name('Publicite.')->group( function() {
        Route::get('/Liste-des-publicites-publier', [PublicityController::class, 'listing'])->name('listing');
        Route::get('/Ajouter-d-une-publicite',[PublicityController::class,'create'])->name('create');
        Route::post('/Ajouter-d-une-publicite',[PublicityController::class,'store'])->name('store');
        //Route for edition
        Route::get('/{id}/edition-d-une-publicite', [PublicityController::class, 'edit'])->name('edit');
        Route::put('/{id}/edition-d-une-publicite', [PublicityController::class, 'update'])->name('update');
        //deleting information
        Route::delete('/{id}/Suprimer-une-publicite', [PublicityController::class, 'delete'])->name('delete');
    });
}) ;
