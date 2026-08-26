<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class AbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apprenant_ids = DB::table("apprenants")->pluck('id')->all();
        $seance_ids = DB::table("seances")->pluck('id')->all();

        

DB::table('absences')->insert([
    [
        'justification'=> 'Maladie',
        'apprenant_id' => $apprenant_ids[0],
        'seance_id'    =>  $seance_ids[0],
        'created_at'   => now(),
        'updated_at'   => now(),
    ],
    [
        'justification'=> 'voyage ',
        'apprenant_id' => $apprenant_ids[1],
        'seance_id'    => $seance_ids[1],
        'created_at'   => now(),
        'updated_at'   => now(),
    ],
    [
        'justification'=> 'probleme de transport ',
        'apprenant_id' => $apprenant_ids[2],
        'seance_id'    => $seance_ids[2],
        'created_at'   => now(),
        'updated_at'   => now(),
    ],
    [
        'justification'=> 'evenement famillial ',
        'apprenant_id' => $apprenant_ids[0],
        'seance_id'    => $seance_ids[1],
        'created_at'   => now(),
        'updated_at'   => now(),
    ],
]);
    echo "absence seeder";
    }
}
