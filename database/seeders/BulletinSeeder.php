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
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'bulletin4' => "c'est dohi",
                'bulletin5' => "c'est dohi",
  
                "niveau_id" => $niveau_ids[5],
                "apprenant_id" => $apprenant_ids[0],
                'annee_scolaire' => "2020-2021",
            ],[
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'bulletin4' => "c'est dohi",
                'bulletin5' => "c'est dohi",
  
                "niveau_id" => $niveau_ids[5],
                "apprenant_id" => $apprenant_ids[1],
                'annee_scolaire' => "2021-2022",
            ],[
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'bulletin4' => "c'est dohi",
                'bulletin5' => "c'est dohi",
  
                "niveau_id" => $niveau_ids[5],
                "apprenant_id" => $apprenant_ids[1],
                'annee_scolaire' => "2024-2025",
            ],[
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'bulletin4' => "c'est dohi",
                'bulletin5' => "c'est dohi",
  
                "niveau_id" => $niveau_ids[5],
                "apprenant_id" => $apprenant_ids[1],
                'annee_scolaire' => "2023-2024",
            ],[
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'bulletin4' => "c'est dohi",
                'bulletin5' => "c'est dohi",
  
                "niveau_id" => $niveau_ids[5],
                "apprenant_id" => $apprenant_ids[0],
                'annee_scolaire' => "2022-2023",
            ]

        ]);
        echo "bulletin seeder";
    }
}
