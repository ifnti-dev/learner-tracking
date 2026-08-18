<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        
                PromotionSeeder::class,
                NiveauSeeder::class,
                PersonneResponsableSeeder::class,
                DocumentPedagogiqueSeeder::class,
                SeanceSeeder::class,
                ApprenantSeeder::class,
                EmpruntSeeder::class,
                AbsenceSeeder::class,
                BulletinSeeder::class,
                ApprenantNiveauSeeder::class,
                ApprenantPersonneResponsableSeeder::class,
                DocumentPedagogiqueEmpruntSeeder::class,

        ]);

    }
}
