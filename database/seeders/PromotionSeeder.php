<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("promotions")->insert([
            [
                "nom"=>"promotion-2022-2024",
                "annee_creation"=>2021
            ],
            [
                "nom"=>"promotion-2020-2021",
                "annee_creation"=>2020
            ],
            [
                "nom"=>"promotion-2024-2025",
                "annee_creation"=>2023
            ]
        ]);

        echo "promotion seeder";
    }
}
