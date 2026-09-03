<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ApprenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promotions_ids = DB::table("promotions")->pluck('id')->all();
        $noveaux_ids = DB::table("niveaux")->pluck('id')->all();
        DB::table('candidats')->insert([
            [
                'nom'            => 'Diallo',
                'prenom'         => 'Aminata',
                'telephone'      => '770000001',
                'email'          => 'aminata.diallo@email.com',
                'etablissement'  => 'Université de kara',
                'sexe'           => 'F',
                'adresse'        => 'Dakar, Sénégal',
                'date_naissance' => '1998-05-12',
                'created_at'     => now(),
                'promotion_id'  => $promotions_ids[0],
                'updated_at'     => now(),
                'niveau_de_base'  => $noveaux_ids[4],
            ],



        ]);


        DB::table('apprenants')->insert([
            [
                'nom'            => 'Sarr',
                'prenom'         => 'Ibrahima',
                'telephone'      => '770000004',
                'email'          => 'ibrahima.sarr@email.com',
                'sexe'           => 'M',
                'adresse'        => 'Kaolack, Sénégal',
                'date_naissance' => '1997-08-15',
                'etablissement' => 'Université de kara',
                'promotion_id'  => $promotions_ids[0],
                'niveau_de_base'  => $noveaux_ids[4],
                'niveau_actuel' => $noveaux_ids[4],
                'cycle_de_base' => '02',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nom'            => 'Ba',
                'prenom'         => 'Fatou',
                'telephone'      => '770000003',
                'email'          => 'fatou.ba@email.com',
                'sexe'           => 'F',
                'adresse'        => 'Saint-Louis, Sénégal',
                'date_naissance' => '2000-02-20',
                'etablissement' => 'École Supérieure Polytechnique',
                'promotion_id'  => $promotions_ids[1],
                'niveau_de_base'  => $noveaux_ids[4],
                'niveau_actuel' => $noveaux_ids[4],
                'cycle_de_base' => '02',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nom'            => 'soulemane',
                'prenom'         => 'Moussa abamassa',
                'telephone'      => '7700004526',
                'email'          => 'abamassa.ndiaye@email.com',
                'sexe'           => 'M',
                'adresse'        => 'Thiès, Sénégal',
                'date_naissance' => '1995-11-03',
                'etablissement' => 'Institut Supérieur d’Informatique',
                'promotion_id'  => $promotions_ids[2],
                'niveau_de_base'  => $noveaux_ids[4],
                'niveau_actuel' => $noveaux_ids[4],
                'cycle_de_base' => '02',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nom'            => 'Ndiaye',
                'prenom'         => 'Moussa',
                'telephone'      => '770000002',
                'email'          => 'moussa.ndiaye@email.com',
                'sexe'           => 'M',
                'adresse'        => 'Thiès, Sénégal',
                'date_naissance' => '1995-11-03',
                'niveau_de_base'  => $noveaux_ids[4],
                'niveau_actuel' => $noveaux_ids[4],
                'cycle_de_base' => '02',
                'etablissement' => 'Université Gaston Berger',
                'promotion_id'  => $promotions_ids[0],
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
        echo "apprenant seeder";
    }
}
