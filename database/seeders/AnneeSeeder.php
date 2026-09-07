<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Annee;

class AnneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fin  = (int)date('Y') + 1;
        $debut = $fin - 10;
        $compteur = $fin - $debut;
        $annee_scolaires  = [];
        for ($i = 0; $i < $compteur; $i++) {
            $annee_scolaires[] = ($debut + $i) . '-' . ($debut + $i + 1);
        }
        $annee_scolaires = array_reverse($annee_scolaires);
        foreach ($annee_scolaires as $annee_scolaire) {
            Annee::create(
                [
                    'annee_scolaire' => $annee_scolaire,
                ],

            );
        }
    }
}
