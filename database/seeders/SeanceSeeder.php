<?php

namespace Database\Seeders;

use App\Enums\Etat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Enums\TypeSeance;

class SeanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_ids = DB::table("users")->pluck('id')->all();
        $promotions_ids = DB::table("promotions")->pluck('id')->all();

        DB::table('seances')->insert([
            [
                'intitule'      => 'Introduction à Laravel',
                'description'   => 'Présentation du framework Laravel et des bases du MVC',
                'date'          => '2026-08-20',
                'heure_debut'   => '09:00:00',
                'heure_fin'     => '12:00:00',
                'type_seance'   => TypeSeance::PRESENTIEL,
                'etat'          => Etat::DEMARRER,
                'user_id'       =>  $user_ids[0],
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
                'etat'          =>Etat::PLANIFIER,
                'user_id'       => $user_ids[2],
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
                'etat'          => Etat::ANNULER,
                'user_id'       => $user_ids[1],
                'promotion_id'  => $promotions_ids[2],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'intitule'      => 'cours de route ',
                'description'   => 'creation de route en laravel',
                'date'          => '2026-08-25',
                'heure_debut'   => '13:00:00',
                'heure_fin'     => '16:30:00',
                'type_seance'   => TypeSeance::ENLIGNE,
                'etat'          => Etat::TERMINER,
                'user_id'       => $user_ids[0],
                'promotion_id'  => $promotions_ids[2],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
        echo "seance seeder";
    }
}
