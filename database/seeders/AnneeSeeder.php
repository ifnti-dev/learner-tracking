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
        Annee::create(
            [
                'annee_scolaire' => '2023-2024',
            ],
            [
                'annee_scolaire' => '2024-2025',
            ],
            [
                'annee_scolaire' => '2025-2026',
            ],
            [
                'annee_scolaire' => '2026-2027',
            ],
            [
                'annee_scolaire' => '2027-2028',
            ]
        );
        
    }
}
