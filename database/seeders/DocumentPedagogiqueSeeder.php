<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DocumentPedagogiqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('document_pedagogiques')->insert([
            [
                'titre'       => 'Cours Laravel Complet',
                'description' => 'Support de cours sur les bases et fonctionnalités avancées de Laravel',
                'auteur'      => 'Jean Dupont',
                'quantite'    => 30,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'titre'       => 'Exercices Base de Données',
                'description' => 'Série d’exercices pratiques sur PostgreSQL et Eloquent',
                'auteur'      => 'Marie Lambert',
                'quantite'    => 25,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'titre'       => 'Guide API REST',
                'description' => 'Documentation pour la création d’API REST sécurisées avec Laravel',
                'auteur'      => 'Thomas Bernard',
                'quantite'    => 20,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'titre'       => 'Manuel Sécurité Web',
                'description' => 'Bonnes pratiques de sécurité pour applications web modernes',
                'auteur'      => 'Sophie Martin',
                'quantite'    => 15,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
        echo "document_pedagogique seeder";
    }
}
