<?php

namespace Database\Seeders;

use App\Enums\TypeNiveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Niveau;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        DB::table('niveaux')->insert([
            // Primaire
            [
                'nom' => 'CE2',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'CM1',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'CM2',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 6ème
            [
                'nom' => '6ème trimestriel',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => '6ème semestriel',
                'type_niveau' => TypeNiveau::SEMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 5ème
            [
                'nom' => '5ème trimestriel',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => '5ème semestriel',
                'type_niveau' => TypeNiveau::SEMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 4ème
            [
                'nom' => '4ème trimestriel',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => '4ème semestriel',
                'type_niveau' => TypeNiveau::SEMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 3ème
            [
                'nom' => '3ème trimestriel',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => '3ème semestriel',
                'type_niveau' => TypeNiveau::SEMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Seconde
            [
                'nom' => 'Seconde trimestriel',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Seconde semestriel',
                'type_niveau' => TypeNiveau::SEMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Première
            [
                'nom' => 'Première trimestriel',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Première semestriel',
                'type_niveau' => TypeNiveau::SEMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // Terminale
            [
                'nom' => 'Terminale trimestriel',
                'type_niveau' => TypeNiveau::TRIMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'Terminale semestriel',
                'type_niveau' => TypeNiveau::SEMESTRIEL->value,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
