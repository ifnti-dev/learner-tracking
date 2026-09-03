<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaiementFrais;

class PaiementFraisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaiementFrais::create([
            'apprenant_id' => 1,
            'niveau_id' => 1,
            'prise_en_charge' => true,
            'montant' => 1000,
            'verse' => true,
            'piece_justificatif' => 'recu.pdf',
            'data' => json_encode(['mode_paiement' => 'Carte bancaire']),
            'annee_scolaire' => '2023-2024',
        ],
        [
            'apprenant_id' => 2,
            'niveau_id' => 2,
            'prise_en_charge' => true,
            'montant' => 2000,
            'verse' => true,
            'piece_justificatif' => 'recu2.pdf',
            'data' => json_encode(['mode_paiement' => 'Virement bancaire']),
            'annee_scolaire' => '2023-2024',
        ]);
    }
}
