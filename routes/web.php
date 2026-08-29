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
    // routes seances et absences
    Route::get('/seances', [SeanceController::class, 'index'])->name('seances.index');
    Route::get('/seances/planifierSeance', [SeanceController::class, 'planifierSeance'])->name('seances.planifierSeance');
    Route::post('/seances/creer', [SeanceController::class, 'creer'])->name('seances.creer');
    Route::patch('/seances/{seance}/demarrer', [SeanceController::class, 'demarrer'])->name('seances.demarrer');
    Route::patch('/seances/{seance}/annuler', [SeanceController::class, 'annuler'])->name('seances.annuler');
    Route::patch('/seances/{seance}/terminer', [SeanceController::class, 'terminer'])->name('seances.terminer');
    Route::get('/seances/{seance}/absents/enregister', [SeanceController::class, 'enregisterAbsents'])->name('seances.enregisterAbsents');
    Route::post('/seances/{seance}/absents', [SeanceController::class, 'enregistrerAbsents'])->name('seances.enregistrerAbsents');
    Route::get('/seances/{seance}/absents', [SeanceController::class, 'voirAbsents'])->name('seances.voirAbsents');
    //candidats
    Route::get('/candidats', [CandidatController::class, 'index'])->name('candidats.index');
    Route::post('/promotions/{candidat}/appouver', [CandidatController::class, 'approuver'])->name('candidater.approuver');
    Route::delete('/promotions/{candidat}/rejeter', [CandidatController::class, 'rejeter'])->name('candidater.rejeter');
});

//Route public

Route::get('/promotions/{promotion}/candidater', [CandidatController::class, 'candidater'])->name('candidater');
Route::post('/promotions/{promotion}/candidater', [CandidatController::class, 'store'])->name('candidater.store');


Route::post('/promotions/{promotion}/apprenants', [PromotionController::class, 'ajouterApprenant'])
    ->name('promotions.apprenants.ajouter');

Route::delete('/promotions/{promotion}/apprenants/{apprenant}', [PromotionController::class, 'retirerApprenant'])
    ->name('promotions.apprenants.retirer');
require __DIR__ . '/auth.php';
