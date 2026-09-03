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
                'code' => '0105',
                'cycle' => '01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'CM1',
                'code' => '0106',
                'cycle' => '01',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'CM2',
                'code' => '0107',
                'cycle' => '01',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 6ème
            [
                'nom' => '6ème',
                'code' => '0201',
                'cycle' => '02',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 5ème
            [
                'nom' => '5ème',
                'code' => '0202',
                'cycle' => '02',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // 4ème
            [
                'nom' => '4ème',
                'code' => '0203',
                'cycle' => '02',
                'created_at' => now(),
                'updated_at' => now()
            ],
            

            // 3ème
            [
                'nom' => '3ème',
                'code' => '0204',
                'cycle' => '02',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Seconde
            [
                'nom' => 'Seconde',
                'code' => '0301',
                'cycle' => '03',
                'created_at' => now(),
                'updated_at' => now()
            ],
 

            // Première
            [
                'nom' => 'Première',
                'code' => '0302',
                'cycle' => '03',
                'created_at' => now(),
                'updated_at' => now()
            ],


            // Terminale
            [
                'nom' => 'Terminale',
                'code' => '0303',
                'cycle' => '03',
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}
