<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BulletinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apprenant_ids = DB::table("apprenants")->pluck('id')->all();
        $niveau_ids = DB::table("niveaux")->pluck('id')->all();


        DB::table('bulletins')->insert([
            [
                'titre'          => 'Bulletin Semestre 1',
                'type_document'  => 'PDF',
                'chemin_fichier' => 'bulletins/semestre1_apprenant1.pdf',
                'data'           => json_encode([
                    'moyenne' => 14.5,
                    'mention' => 'Bien',
                    'matieres' => [
                        ['nom' => 'Laravel', 'note' => 16],
                        ['nom' => 'Base de données', 'note' => 13],
                    ]
                ]),
                'niveau_id'      => $niveau_ids[0],
                'apprenant_id'   => $apprenant_ids[0],
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'titre'          => 'Bulletin Semestre 1',
                'type_document'  => 'PDF',
                'chemin_fichier' => 'bulletins/semestre1_apprenant2.pdf',
                'data'           => json_encode([
                    'moyenne' => 12.8,
                    'mention' => 'Assez Bien',
                    'matieres' => [
                        ['nom' => 'Laravel', 'note' => 14],
                        ['nom' => 'Base de données', 'note' => 11.5],
                    ]
                ]),
                'niveau_id'      => $niveau_ids[1],
                'apprenant_id'   => $apprenant_ids[1],
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'titre'          => 'Bulletin Semestre 2',
                'type_document'  => 'PDF',
                'chemin_fichier' => 'bulletins/semestre2_apprenant3.pdf',
                'data'           => json_encode([
                    'moyenne' => 16.2,
                    'mention' => 'Très Bien',
                    'matieres' => [
                        ['nom' => 'API REST', 'note' => 17],
                        ['nom' => 'Sécurité', 'note' => 15.5],
                    ]
                ]),
                'niveau_id'      => $niveau_ids[0],
                'apprenant_id'   => $apprenant_ids[2],
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'titre'          => 'Bulletin Final',
                'type_document'  => 'PDF',
                'chemin_fichier' => 'bulletins/final_apprenant4.pdf',
                'data'           => json_encode([
                    'moyenne' => 13.7,
                    'mention' => 'Assez Bien',
                    'matieres' => [
                        ['nom' => 'Projet', 'note' => 15],
                        ['nom' => 'Soutenance', 'note' => 12.5],
                    ]
                ]),
                'niveau_id'      => $niveau_ids[2],
                'apprenant_id'   => $apprenant_ids[1],
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
        echo "bulletin seeder";
    }
}
