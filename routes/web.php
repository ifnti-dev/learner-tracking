<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonneResponsableController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\PromotionController;


Route::get('/', function () {
    return to_route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources(
        [
            'personne-responsables' => PersonneResponsableController::class,
            'apprenants' => ApprenantController::class,
            'promotions' => PromotionController::class,
        ]
    );
});

//Route public

Route::get('/inscription',[CandidatController::class,'inscription'])->name('inscription');
Route::post('/inscription',[CandidatController::class,'store'])->name('inscription.store');
require __DIR__.'/auth.php';
