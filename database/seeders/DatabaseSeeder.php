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
                RoleSeeder::class,
                PermissionSeeder::class,
                RolePermissionSeeder::class,

                AnneeSeeder::class,
                PromotionSeeder::class,
                NiveauSeeder::class,
                PersonneResponsableSeeder::class,
                DocumentPedagogiqueSeeder::class,
                UserSeeder::class,
                SeanceSeeder::class,
                ApprenantSeeder::class,
                ApprenantNiveauSeeder::class,
                EmpruntSeeder::class,
                AbsenceSeeder::class,
                BulletinSeeder::class,
                ApprenantPersonneResponsableSeeder::class,
                DocumentPedagogiqueEmpruntSeeder::class,
                PaiementFraisSeeder::class,
        ]);

    }
}
