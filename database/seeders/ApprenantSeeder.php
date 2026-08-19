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
        DB::table('candidats')->insert([
            [
                'nom'            => 'Diallo',
                'prenom'         => 'Aminata',
                'telephone'      => '770000001',
                'email'          => 'aminata.diallo@email.com',
                'password'       => Hash::make('password123'),
                'sexe'           => 'F',
                'adresse'        => 'Dakar, Sénégal',
                'date_naissance' => '1998-05-12',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nom'            => 'Ndiaye',
                'prenom'         => 'Moussa',
                'telephone'      => '770000002',
                'email'          => 'moussa.ndiaye@email.com',
                'password'       => Hash::make('password123'),
                'sexe'           => 'M',
                'adresse'        => 'Thiès, Sénégal',
                'date_naissance' => '1995-11-03',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nom'            => 'soulemane',
                'prenom'         => 'Moussa abamassa',
                'telephone'      => '7700004526',
                'email'          => 'abamassa.ndiaye@email.com',
                'password'       => Hash::make('123456789'),
                'sexe'           => 'M',
                'adresse'        => 'Thiès, Sénégal',
                'date_naissance' => '1995-11-03',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nom'            => 'Ba',
                'prenom'         => 'Fatou',
                'telephone'      => '770000003',
                'email'          => 'fatou.ba@email.com',
                'password'       => Hash::make('password123'),
                'sexe'           => 'F',
                'adresse'        => 'Saint-Louis, Sénégal',
                'date_naissance' => '2000-02-20',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nom'            => 'Sarr',
                'prenom'         => 'Ibrahima',
                'telephone'      => '770000004',
                'email'          => 'ibrahima.sarr@email.com',
                'password'       => Hash::make('password123'),
                'sexe'           => 'M',
                'adresse'        => 'Kaolack, Sénégal',
                'date_naissance' => '1997-08-15',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);


        DB::table('apprenants')->insert([
            [
                'etablissement' => 'Université de kara',
                'promotion_id'  => $promotions_ids[0],
                'candidat_id'   => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'etablissement' => 'École Supérieure Polytechnique',
                'promotion_id'  => $promotions_ids[1],
                'candidat_id'   => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'etablissement' => 'Institut Supérieur d’Informatique',
                'promotion_id'  => $promotions_ids[2],
                'candidat_id'   => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'etablissement' => 'Université Gaston Berger',
                'promotion_id'  => $promotions_ids[0],
                'candidat_id'   => 4,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
        echo "apprenant seeder";
    }
}
