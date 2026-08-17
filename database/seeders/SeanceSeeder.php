<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Enums\TypeSeance;
class SeanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "nom" => "BABA",
                "prenom" => "Aliou",
                "mot_de_passe" =>Hash::make("123456789"),
                "email" => "aliou@gmail.com",
                "telephone" => 93786260,
                "sexe" => "M"
            ],
            [
                "nom" => "ASSOUMANAOU",
                "prenom" => "Essofa",
                "mot_de_passe" =>Hash::make("essofa123"),
                "email" => "essofa@gmail.com",
                "telepho.ne" => 90786260,
                "sexe" => "M"
            ],
            [
                "nom" => "ABOUBAKAR",
                "prenom" => "sakirou",
                "mot_de_passe" =>Hash::make("sakirou236"),
                "email" => "sakirou@gmail.com",
                "telephone" => 91736260,
                "sexe" => "M"
            ],
            [
                "nom" => "BAMASSI",
                "prenom" => "Fadila",
                "mot_de_passe" =>Hash::make("236558"),
                "email" => "fadilabamassi@gmail.com",
                "telephone" => 70706260,
                "sexe" => "F"
            ]
        ]);
        $promotions_ids = DB::table("promotions")->pluck('id')->all();


        DB::table('seances')->insert([
            [
                'intitule'      => 'Introduction à Laravel',
                'description'   => 'Présentation du framework Laravel et des bases du MVC',
                'date'          => '2026-08-20',
                'heure_debut'   => '09:00:00',
                'heure_fin'     => '12:00:00',
                'type_seance'   =>TypeSeance::PRESENTIEL,
                'user_id'       => 1,
                'promotion_id'  => $promotions_ids[0],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'intitule'      => 'Les migrations et Eloquent',
                'description'   => 'Création de tables et manipulation des modèles Eloquent',
                'date'          => '2026-08-21',
                'heure_debut'   => '14:00:00',
                'heure_fin'     => '17:00:00',
                'type_seance'   => TypeSeance::ENLIGNE,
                'user_id'       => 2,
                'promotion_id'  => $promotions_ids[1],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'intitule'      => 'Authentification et Middleware',
                'description'   => 'Mise en place de l’authentification et gestion des accès',
                'date'          => '2026-08-22',
                'heure_debut'   => '09:30:00',
                'heure_fin'     => '11:30:00',
                'type_seance'   => TypeSeance::PRESENTIEL,
                'user_id'       => 3,
                'promotion_id'  => $promotions_ids[2],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'intitule'      => 'API REST avec Laravel',
                'description'   => 'Création d’une API REST complète avec authentification Sanctum',
                'date'          => '2026-08-25',
                'heure_debut'   => '13:00:00',
                'heure_fin'     => '16:30:00',
                'type_seance'   => TypeSeance::ENLIGNE,
                'user_id'       => 4,
                'promotion_id'  => $promotions_ids[2],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
        echo "seance seeder";
    }
}
