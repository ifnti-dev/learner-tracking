<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprenantPersonneResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apprenant_ids = DB::table("apprenants")->pluck('id')->all();
        $personne_responsable_ids = DB::table("personne_responsables")->pluck('id')->all();

        DB::table('apprenant_personne_responsable')->insert([
            [
                'apprenant_id'             => $apprenant_ids[0],
                'personne_responsable_id'  => $personne_responsable_ids[0],
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
            [
                'apprenant_id'             => $apprenant_ids[1],
                'personne_responsable_id'  => $personne_responsable_ids[1],
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
            [
                'apprenant_id'             => $apprenant_ids[1],
                'personne_responsable_id'  => $personne_responsable_ids[2],
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
            [
                'apprenant_id'             => $apprenant_ids[0],
                'personne_responsable_id'  => $personne_responsable_ids[0],
                'created_at'               => now(),
                'updated_at'               => now(),
            ],
        ]);
        echo "apprenant_personne_responsable";
    }
}
