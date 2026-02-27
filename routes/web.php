<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Routes pour la gestion immobilière - sans middleware de rôle
    Route::get('/proprietaires', 'App\Http\Controllers\ProprietaireController@index')->name('proprietaires.index');
    Route::get('/proprietaires/create', 'App\Http\Controllers\ProprietaireController@create')->name('proprietaires.create');
    Route::post('/proprietaires', 'App\Http\Controllers\ProprietaireController@store')->name('proprietaires.store');
    Route::get('/proprietaires/{proprietaire}', 'App\Http\Controllers\ProprietaireController@show')->name('proprietaires.show');
    Route::get('/proprietaires/{proprietaire}/edit', 'App\Http\Controllers\ProprietaireController@edit')->name('proprietaires.edit');
    Route::put('/proprietaires/{proprietaire}', 'App\Http\Controllers\ProprietaireController@update')->name('proprietaires.update');
    Route::delete('/proprietaires/{proprietaire}', 'App\Http\Controllers\ProprietaireController@destroy')->name('proprietaires.destroy');

    // Routes pour les biens immobiliers
    Route::get('/biens', 'App\Http\Controllers\BienImmobilierController@index')->name('biens.index');
    Route::get('/biens/create', 'App\Http\Controllers\BienImmobilierController@create')->name('biens.create');
    Route::post('/biens', 'App\Http\Controllers\BienImmobilierController@store')->name('biens.store');
    Route::get('/biens/{bien}', 'App\Http\Controllers\BienImmobilierController@show')->name('biens.show');
    Route::get('/biens/{bien}/edit', 'App\Http\Controllers\BienImmobilierController@edit')->name('biens.edit');
    Route::put('/biens/{bien}', 'App\Http\Controllers\BienImmobilierController@update')->name('biens.update');
    Route::delete('/biens/{bien}', 'App\Http\Controllers\BienImmobilierController@destroy')->name('biens.destroy');

    // Routes pour les parcelles
    Route::get('/parcelles', 'App\Http\Controllers\ParcelleController@index')->name('parcelles.index');
    Route::get('/parcelles/create', 'App\Http\Controllers\ParcelleController@create')->name('parcelles.create');
    Route::post('/parcelles', 'App\Http\Controllers\ParcelleController@store')->name('parcelles.store');
    Route::get('/parcelles/{parcelle}', 'App\Http\Controllers\ParcelleController@show')->name('parcelles.show');
    Route::get('/parcelles/{parcelle}/edit', 'App\Http\Controllers\ParcelleController@edit')->name('parcelles.edit');
    Route::put('/parcelles/{parcelle}', 'App\Http\Controllers\ParcelleController@update')->name('parcelles.update');
    Route::delete('/parcelles/{parcelle}', 'App\Http\Controllers\ParcelleController@destroy')->name('parcelles.destroy');

    // Routes pour les motos (Zem)
    Route::get('/motos', 'App\Http\Controllers\MotoController@index')->name('motos.index');
    Route::get('/motos/create', 'App\Http\Controllers\MotoController@create')->name('motos.create');
    Route::post('/motos', 'App\Http\Controllers\MotoController@store')->name('motos.store');
    Route::get('/motos/{moto}', 'App\Http\Controllers\MotoController@show')->name('motos.show');
    Route::get('/motos/{moto}/edit', 'App\Http\Controllers\MotoController@edit')->name('motos.edit');
    Route::put('/motos/{moto}', 'App\Http\Controllers\MotoController@update')->name('motos.update');
    Route::delete('/motos/{moto}', 'App\Http\Controllers\MotoController@destroy')->name('motos.destroy');

    // Routes pour les locations de motos (Zem)
    Route::get('/locations-motos', 'App\Http\Controllers\LocationMotoController@index')->name('locations_motos.index');
    Route::get('/locations-motos/create', 'App\Http\Controllers\LocationMotoController@create')->name('locations_motos.create');
    Route::post('/locations-motos', 'App\Http\Controllers\LocationMotoController@store')->name('locations_motos.store');
    Route::get('/locations-motos/{location}', 'App\Http\Controllers\LocationMotoController@show')->name('locations_motos.show');
    Route::get('/locations-motos/{location}/edit', 'App\Http\Controllers\LocationMotoController@edit')->name('locations_motos.edit');
    Route::put('/locations-motos/{location}', 'App\Http\Controllers\LocationMotoController@update')->name('locations_motos.update');
    Route::delete('/locations-motos/{location}', 'App\Http\Controllers\LocationMotoController@destroy')->name('locations_motos.destroy');
    Route::post('/locations-motos/{location}/terminer', 'App\Http\Controllers\LocationMotoController@terminer')->name('locations_motos.terminer');

    // Routes pour les locations de biens immobiliers
    Route::get('/locations-biens', 'App\Http\Controllers\LocationBienController@index')->name('locations_biens.index');
    Route::get('/locations-biens/create', 'App\Http\Controllers\LocationBienController@create')->name('locations_biens.create');
    Route::post('/locations-biens', 'App\Http\Controllers\LocationBienController@store')->name('locations_biens.store');
    Route::get('/locations-biens/{location}', 'App\Http\Controllers\LocationBienController@show')->name('locations_biens.show');
    Route::get('/locations-biens/{location}/edit', 'App\Http\Controllers\LocationBienController@edit')->name('locations_biens.edit');
    Route::put('/locations-biens/{location}', 'App\Http\Controllers\LocationBienController@update')->name('locations_biens.update');
    Route::delete('/locations-biens/{location}', 'App\Http\Controllers\LocationBienController@destroy')->name('locations_biens.destroy');
    Route::post('/locations-biens/{location}/resilier', 'App\Http\Controllers\LocationBienController@resilier')->name('locations_biens.resilier');
    Route::post('/locations-biens/{location}/paiement', 'App\Http\Controllers\LocationBienController@enregistrerPaiement')->name('locations_biens.paiement');

    // Routes pour la journalisation
    Route::get('/journalisation', 'App\Http\Controllers\JournalisationController@index')->name('journalisation.index');
    Route::get('/journalisation/{reference}', 'App\Http\Controllers\JournalisationController@show')->name('journalisation.show');
});

require __DIR__.'/auth.php';
