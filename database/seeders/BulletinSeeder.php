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
        $niveau_apprenant = DB::table('apprenant_niveaux')
            
            ->get();                    
        

        DB::table('bulletins')->insert([
            [
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'releveCEPD' => "c'est dohi",
                'releveBEPC' => "c'est dohi",
                'releveBAC1' => "c'est dohi",
                'releveBAC2' => "c'est dohi",
                'apprenant_niveau_id' => $niveau_apprenant[0]->id,
                
            ],[
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'releveCEPD' => "c'est dohi",
                'releveBEPC' => "c'est dohi",
                'releveBAC1' => "c'est dohi",
                'releveBAC2' => "c'est dohi",

                'apprenant_niveau_id' => $niveau_apprenant[0]->id,
            ],[
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'releveCEPD' => "c'est dohi",
                'releveBEPC' => "c'est dohi",
                'releveBAC1' => "c'est dohi",
                'releveBAC2' => "c'est dohi",

                'apprenant_niveau_id' => $niveau_apprenant[0]->id,
            ],[
                'bulletin1' => "c'est dohi",
                'bulletin2' => "c'est dohi",
                'bulletin3' => "c'est dohi",
                'releveCEPD' => "c'est dohi",
                'releveBEPC' => "c'est dohi",
                'releveBAC1' => "c'est dohi",
                'releveBAC2' => "c'est dohi",
                'apprenant_niveau_id' => $niveau_apprenant[0]->id,
            ]

        ]);
        echo "bulletin seeder";
    }
}
