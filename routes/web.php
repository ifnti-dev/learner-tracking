<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonneResponsableController;
use App\Http\Controllers\ApprenantController;
use App\Http\Controllers\BulletinController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\DocumentPedagogiqueController;
use App\Http\Controllers\PaiementFraisController;

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
             'document-pedagogiques'=>DocumentPedagogiqueController::class
            
        ]
    );
    //custom index for bulletin
    Route::get("bulletins/{apprenant}/",[BulletinController::class,'bulletins'])->name('bulletins');
    Route::get("bulletins/{bulletin}/{apprenant}/edit",[BulletinController::class,'edit'])->name('bulletins.edit');
    Route::put("bulletins/{bulletin}/{apprenant}/",[BulletinController::class,'update'])->name('bulletins.update');;
    Route::get("bulletins/{apprenant}/create",[BulletinController::class,'create'])->name('bulletins.create');;
    Route::post("bulletins/{apprenant}/",[BulletinController::class,'store'])->name('bulletins.store');;
    Route::delete("bulletins/{bulletin}/",[BulletinController::class,'destroy'])->name('bulletins.destroy');;
    //custom index for paiement frais
    Route::get("paiement_frais/{apprenant}/",[PaiementFraisController::class,'index'])->name('paiement_frais');
    Route::get("paiement_frais/{paiementFrais}/{apprenant}/edit",[PaiementFraisController::class,'edit'])->name('paiement_frais.edit');
    Route::put("paiement_frais/{paiementFrais}/{apprenant}/",[PaiementFraisController::class,'update'])->name('paiement_frais.update');;
    Route::get("paiement_frais/{apprenant}/create",[PaiementFraisController::class,'create'])->name('paiement_frais.create');;
    Route::post("paiement_frais/{apprenant}/",[PaiementFraisController::class,'store'])->name('paiement_frais.store');; 
    Route::delete("paiement_frais/{paiementFrais}/",[PaiementFraisController::class,'destroy'])->name('paiement_frais.destroy');;

    // routes seances et absences
    Route::get('/seances', [SeanceController::class, 'index'])->name('seances.index');
    Route::get('/seances/planifierSeance', [SeanceController::class, 'planifierSeance'])->name('seances.planifierSeance');
    Route::post('/seances/creer', [SeanceController::class, 'creer'])->name('seances.creer');
    Route::patch('/seances/{seance}/demarrer', [SeanceController::class, 'demarrer'])->name('seances.demarrer');
    Route::patch('/seances/{seance}/annuler', [SeanceController::class, 'annuler'])->name('seances.annuler');
    Route::patch('/seances/{seance}/terminer', [SeanceController::class, 'terminer'])->name('seances.terminer');
    Route::get('/seances/{seance}/absents/mentionner', [SeanceController::class, 'mentionnerAbsents'])->name('seances.mentionnerAbsents');
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
