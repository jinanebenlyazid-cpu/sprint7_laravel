<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoyageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiController;

Route::get('/voyages/search', [ApiController::class, 'search']);
Route::get('/voyages/villes', [ApiController::class, 'villes']);


Route::get('/', [VoyageController::class, 'accueil']);


Route::get('/rechercher',[VoyageController::class,'formRecherche']);
Route::get('/rechercher/resultats',[VoyageController::class,'resultatRecherche']);

// Cart
Route::post('/cart/add',     [CartController::class, 'add'])->name('cart.add');
Route::get('/cart',          [CartController::class, 'show'])->name('cart.show');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove',[CartController::class, 'remove'])->name('cart.remove');


Route::get('/voyageurs',     [CommandeController::class, 'formVoyageurs']);

Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

Route::get('/paiement',  [CommandeController::class, 'showPaiement']); // ✅ واحد فقط
Route::post('/paiement', [CommandeController::class, 'payer']);
Route::get('/billets/{id}',  [CommandeController::class, 'billets']);
Route::get('/mes-billets',   [CommandeController::class, 'mesBillets']);