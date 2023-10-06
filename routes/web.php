<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarInformationController;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientSpaceController;
use App\Http\Controllers\ColisController;
use App\Http\Controllers\CompteControllers;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PassengerVerificationController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\HomeAdminController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicityController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationPublicController;
use App\Http\Controllers\TravelController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\UsersController;
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

//Routes for public generals

Route::prefix('/')->name('Public.')->group( function (){
    //for policy
    Route::get('/policy', [ColisController::class, 'condition'])->name('condition');
    Route::get('/terms-of-policy', [ColisController::class, 'terme'])->name('terme');
    //for public
    Route::get('/', [PublicController::class, 'index'])->name('index');
    Route::post('/', [ContactController::class, 'store'])->name('store');
    //Service
    Route::get('/Nos-prestation', [PublicController::class, 'service'])->name('service');
    //Contacte page
    Route::get('/nous-contacter',[PublicController::class, 'contact'])->name('contacts');
    Route::post('/nous-contacter',[ContactController::class, 'stores'])->name('contacts.store');
    //infromation
    Route::get('/Information', [PublicController::class, 'information'])->name('information');

    //for colis express
    Route::prefix('/colis')->name('Colis.')->group( function () {
        Route::get('/', [ColisController::class, 'index'])->name('index');
    });
    // for transport
    Route::prefix('/transport')->name('Personel.')->group( function () {
        Route::get('/', [PersonnelController::class, 'index'])->name('index');
    });

    //for reservation
    Route::prefix('/reservation')->name('Reservation.')->middleware('auth')->group( function () {
        Route::get('/', [ReservationPublicController::class, 'index'])->name('index');
        //information sur une voiture
        Route::get('/voiture/a5{id}6z', [ReservationPublicController::class, 'car'])->name('car');
        //only for user connected
        Route::prefix('/Authentified-user')->name('Auth.')->group( function () {
            //request for initiate the reservation
            Route::get('/za89{tripId}13aaz-c22{carId}-87s', [ReservationPublicController::class, 'passenger'])->name('passenger');
            Route::post('/za89{tripId}13aaz-c22{carId}-87s', [ReservationPublicController::class, 'passenger_add'])->name('passenger_add');
            //success
            Route::get('/P85-oi{reservationId}7-Z742b', [ReservationPublicController::class, 'success'])->name('success');

            //Download pdf
            Route::get('/Download-Reservation-pdf/St87{reservationId}752tp', [ReservationPublicController::class, 'generatePDF'])->name('PdfG');
        });
    });
});

//for User client only
Route::prefix('Client')->middleware(['auth', 'verified'])->name('Client.')->group( function () {
    Route::get('/', [ClientSpaceController::class, 'client'])->name('index');
    Route::post('/286{reservationId}548-abord', [ClientSpaceController::class, 'abord'])->name('abord');
});


Route::prefix('/Administration')->middleware(['auth', 'verified', 'checkRole:1'])->name('Admin.')->group( function() {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    //Home Admin Routes
    Route::prefix('/Acceuil-administration')->name('Home.')->group( function() {
        Route::get('/',[HomeAdminController::class, 'index'])->name('index');
        //Adding routes
        Route::get('/ajouter-pub', [HomeAdminController::class, 'create'])->name('create');
        Route::post('/ajouter-pub', [HomeAdminController::class, 'store'])->name('store');
        //edition routes
        Route::get('/{id}/editer', [HomeAdminController::class, 'edit'])->name('edit');
        Route::put('/{id}/editer', [HomeAdminController::class, 'update'])->name('update');
        //deleting
        Route::delete('/{id}/delete', [HomeAdminController::class, 'delete'])->name('delete');
    });

    //flote
    Route::prefix('/Entreprise/nos-flote')->name('Entreprise.flote.')->group( function () {
        //listing
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        //creation view
        Route::get('/creation', [CategoryController::class, 'create'])->name('create');
        Route::post('/creation', [CategoryController::class, 'store'])->name('store');
        //edition
        Route::get('/{id}/mis-a-jour',[CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/mis-a-jour', [CategoryController::class, 'update'])->name('update');
    });

    //Cars
    Route::prefix('/Entreprise/nos-flote')->name('Entreprise.flote.car.')->group( function () {
        Route::get('/voiture', [CarController::class, 'index'])->name('index');
        Route::get('/voiture/Ajout-d-un-voiture', [CarController::class, 'create'])->name('create');
        Route::post('/voiture/Ajout-d-un-voiture', [CarController::class, 'store'])->name('store');
        Route::get('/voiture/{id}/Edition-d-un-voiture', [CarController::class, 'edit'])->name('edit');
        Route::put('/voiture/{id}/Edition-d-un-voiture', [CarController::class, 'update'])->name('update');
        Route::delete('/voiture/{id}/Supression-d-un-voiture', [CarController::class, 'delete'])->name('delete');
        //view of one car
        Route::get('/voiture/{id}/Vue-d-un-voiture', [CarController::class, 'view'])->name('view');
        //return pdf download
        Route::get('/voiture/{id}/pdf', [CarController::class, 'generatePDF'])->name('generatePDF');

        //car listing by float
        Route::get('/liste-des-voiture-par-flote', [CarListingController::class, 'index'])->name('listing.flote.index');
        Route::get('/liste-des-voiture-par-flote/{id}/{category}', [CarListingController::class, 'listing'])->name('listing.flote.listing');
        //car information
        Route::get('/voiture/information', [CarInformationController::class, 'index'])->name('carInformation.index');
        Route::get('/voiture/information/ajouter-information-pour-un-voiture', [CarInformationController::class, 'create'])->name('carInformation.create');
        Route::post('/voiture/information/ajouter-information-pour-un-voiture', [CarInformationController::class, 'store'])->name('carInformation.store');
    });




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
    //Route for contact
    Route::prefix('/Contact')->name('Contact.')->group( function () {
        Route::get('/Liste-de-tous-les-messages-recu', [ContactController::class, 'listing'])->name('listing');
        Route::get('/2365Aki8/Pmo{id}25sa587Auz/Message', [ContactController::class, 'view'])->name('view');
     });

     //Route for personale users
    Route::prefix('/UtilisateurX')->name('Utilisateur.')->group( function () {
        Route::get('/Mon-profile', [UsersController::class, 'profile'])->name('profile');
        Route::get('/Edition-de-mon-profile', [UsersController::class, 'edit'])->name('edit');
        Route::put('/Edition-de-mon-profile', [UsersController::class, 'update'])->name('update');
    });

    //Routes for compte management
    Route::prefix('/Gestion-des-compte')->name('Compte.')->group( function () {
        Route::get('/', [CompteControllers::class, 'listing'])->name('listing');
        Route::get('/edition/125{id}7954', [CompteControllers::class, 'edit'])->name('edit');
        Route::put('/edition/125{id}7954', [CompteControllers::class, 'updateRole'])->name('updateRole');
        Route::delete('/supression/125{id}7954', [CompteControllers::class, 'deleteUser'])->name('deleteUser');
        //forbiden error
        Route::get('/acces-refuser', [CompteControllers::class, 'forbiden'])->name('forbiden');
    })->middleware('is_admin');
    //Routes for message
    Route::prefix('/Message')->name('Message.')->group( function (){
        Route::get('/', [MessageController::class, 'allMessage'])->name('allMessage');
        // get discution One to One
        Route::get('/az8-z{participant}54sa58-89/message', [MessageController::class, 'discution'])->name('discution');
        // post discution One to One
        Route::post('/az8-z{participant}54sa58-89/message', [MessageController::class, 'send'])->name('send');
        //Get conversation
        Route::get('/az8-z{participant}54sa58-89/conversation', [MessageController::class, 'discutionOneOne'])->name('discutionOneOne');
    });
    //Routes for creation of new message
    Route::prefix('/Message-Création')->name('Message.Creation.')->group( function (){
        Route::get('/',[ParticipantController::class, 'index'])->name('index');
        Route::post('/',[ParticipantController::class, 'create'])->name('create');
    });

     //Route for passenger verification and passenger list
    Route::prefix('/Verification-passager')->name('Verification.Passenger.')->group( function() {
        Route::get('/', [PassengerVerificationController::class, 'reservation'])->name('listing');
        Route::get('/{id}/Liste-des-passager', [PassengerVerificationController::class, 'verify'])->name('verify');
        Route::get('/{identification}', [PassengerVerificationController::class, 'passenger'])->name('view');
    });
}) ;
