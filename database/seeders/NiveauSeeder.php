<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        DB::table('niveaux')->insert([
            [
                'nom'=> 'CE2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom'        => '6eme',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom'        => 'premiere',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom'        => 'seconde',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        echo "niveau seeder";
    }
}
