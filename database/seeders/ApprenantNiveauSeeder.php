<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ApprenantNiveau;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ApprenantNiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $annees_id = DB::table('annees')->get();
        ApprenantNiveau::create([
            'apprenant_id' => 1,
            'niveau_id' => 1,
            'annee_id' => $annees_id[0]->id,
        ],
        [
            'apprenant_id' => 2,
            'niveau_id' => 2,
            'annee_id' => $annees_id[0]->id,
        ],
        [
            'apprenant_id' => 3,
            'niveau_id' => 3,
            'annee_id' => $annees_id[0]->id,
        ],
        [
            'apprenant_id' => 4,
            'niveau_id' => 4,
            'annee_id' => $annees_id[0]->id,
        ],
        [
            'apprenant_id' => 5,
            'niveau_id' => 5,
            'annee_id' => $annees_id[0]->id,
        ],
        [
            'apprenant_id' => 6,
            'niveau_id' => 6,
            'annee_id' => $annees_id[0]->id,
        ]);
    }
}
