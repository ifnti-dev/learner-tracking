<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonneResponsableController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SeanceController;

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
    Route::get('/seances', [SeanceController::class, 'index'])->name('seances.index');
    Route::get('/seances/planifierSeance', [SeanceController::class, 'planifierSeance'])->name('seances.planifierSeance');
    Route::post('/seances/planifier', [SeanceController::class, 'planifier'])->name('seances.planifier');
    Route::get('/seances/{seance}/create', [SeanceController::class, 'create'])->name('seances.create');
    Route::post('/seances/{seance}/creer', [SeanceController::class, 'store'])
        ->name('seances.store');
    Route::get('/seances/{seance}/absences', [SeanceController::class, 'absences'])->name('seances.absences');
});

//Route public

Route::get('/inscription', [CandidatController::class, 'inscription'])->name('inscription');
Route::post('/inscription', [CandidatController::class, 'store'])->name('inscription.store');


Route::post('/promotions/{promotion}/apprenants', [PromotionController::class, 'ajouterApprenant'])
    ->name('promotions.apprenants.ajouter');

Route::delete('/promotions/{promotion}/apprenants/{apprenant}', [PromotionController::class, 'retirerApprenant'])
    ->name('promotions.apprenants.retirer');
require __DIR__ . '/auth.php';
