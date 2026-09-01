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
                'titre'       => 'document de mathematique',
                'description' => 'limite et continuité',
                'auteur'      => 'Jean Dupont',
                'quantite'    => 30,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'titre'       => 'document anglais',
                'description' => 'verbe regulier en anglais',
                'auteur'      => 'Marie Lambert',
                'quantite'    => 25,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'titre'       => 'document de physique chimie',
                'description' => 'loi de la pesenture',
                'auteur'      => 'Thomas Bernard',
                'quantite'    => 20,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'titre'       => 'art de conjuguer',
                'description' => 'conjugugaison sur les verbes ',
                'auteur'      => 'Sophie Martin',
                'quantite'    => 15,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
        echo "document_pedagogique seeder";
    }
}
