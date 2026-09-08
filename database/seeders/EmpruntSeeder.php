<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpruntSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('emprunts')->insert([
            [
                'date_restitution_prevue'=>'12-10-2026',
                'apprenant_id'      => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
                'date_restitution' => null
            ],
            [
                'date_restitution_prevue'=>'05-09-2026',
                'apprenant_id'      => 2,
                'created_at'        => now(),
                'updated_at'        => now(),
                'date_restitution' => null
            ],
            [
                'date_restitution_prevue'=>'06-09-2026',
                'apprenant_id'      => 3,
                'created_at'        => now(),
                'updated_at'        => now(),
                'date_restitution' => null
            ],
            [
                'date_restitution_prevue'=>'08-09-2026',
                'apprenant_id'      => 4,
                'created_at'        => now(),
                'updated_at'        => now(),
                'date_restitution' => null
            ],
        ]);
        echo "emprunt seeder";
    }
}
