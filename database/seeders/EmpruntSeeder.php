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
                'date'              => '2026-08-01',
                'date_restitution'  => '2026-08-15',
                'apprenant_id'      => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'date'              => '2026-08-03',
                'date_restitution'  => '2026-08-17',
                'apprenant_id'      => 2,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'date'              => '2026-08-05',
                'date_restitution'  => '2026-08-20',
                'apprenant_id'      => 3,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'date'              => '2026-08-07',
                'date_restitution'  => '2026-08-21',
                'apprenant_id'      => 4,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
        echo "emprunt seeder";
    }
}
