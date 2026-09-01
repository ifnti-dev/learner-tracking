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
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'CM1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'CM2',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 6ème
            [
                'nom' => '6ème',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 5ème
            [
                'nom' => '5ème',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 4ème
            [
                'nom' => '4ème',
                'created_at' => now(),
                'updated_at' => now()
            ],
            

            // 3ème
            [
                'nom' => '3ème',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Seconde
            [
                'nom' => 'Seconde',
                'created_at' => now(),
                'updated_at' => now()
            ],
 

            // Première
            [
                'nom' => 'Première',
                'created_at' => now(),
                'updated_at' => now()
            ],


            // Terminale
            [
                'nom' => 'Terminale',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}
