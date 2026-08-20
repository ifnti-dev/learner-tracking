<?php

use App\Models\Apprenant;
use App\Models\Candidat;
use App\Models\PersonneResponsable;
use App\Models\User;

it('stores an apprenant with its candidate and responsible person', function () {
    $user = User::factory()->create();

    $candidate = Candidat::create([
        'nom' => 'Mawuli',
        'prenom' => 'Sika',
        'telephone' => '90000001',
        'email' => 'mawuli@example.com',
        'password' => bcrypt('password'),
        'sexe' => 'M',
        'adresse' => 'Lomé',
        'date_naissance' => '2008-03-14',
    ]);

    $responsable = PersonneResponsable::create([
        'nom' => 'Afi',
        'prenom' => 'Kokou',
        'telephone' => '90000002',
        'type' => 'PERE',
    ]);

    $response = $this->actingAs($user)->post(route('apprenants.store'), [
        'candidat_id' => $candidate->id,
        'nom' => 'Mawuli',
        'prenom' => 'Sika',
        'telephone' => '90000003',
        'email' => 'mawuli.apprenant@example.com',
        'sexe' => 'M',
        'adresse' => 'Lomé',
        'date_naissance' => '2008-03-14',
        'etablissement' => 'Collège Moderne',
        'personne_responsable_id' => $responsable->id,
    ]);

    $response->assertRedirect(route('apprenants.index'));

    $apprenant = Apprenant::query()->where('email', 'mawuli.apprenant@example.com')->firstOrFail();

    expect($apprenant->candidat_id)->toBe($candidate->id)
        ->and($apprenant->personneResponsables()->whereKey($responsable->id)->exists())->toBeTrue();
});
