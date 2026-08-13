<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApprenantNiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apprenant_ids = DB::table("apprenants")->pluck('id')->all();
        $niveau_ids = DB::table("niveaux")->pluck('id')->all();
        DB::table('apprenant_niveau')->insert([
            [
                'apprenant_id' => $apprenant_ids[0],
                'niveau_id'    => $niveau_ids[0],
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'apprenant_id' => $apprenant_ids[1],
                'niveau_id'    => $niveau_ids[0],
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'apprenant_id' => $apprenant_ids[0],
                'niveau_id'    => $niveau_ids[1],
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'apprenant_id' => $apprenant_ids[1],
                'niveau_id'    => $niveau_ids[2],
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
        echo "apprenant_niveau seeder";
    }
}
