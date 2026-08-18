<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->insert([
            [
                "nom" => "BABA",
                "prenom" => "Aliou",
                "password" => Hash::make("123456789"),
                "email" => "respo@gmail.com",
                "telephone" => 93786260,
                "sexe" => "M"
            ],
            [
                "nom" => "TCHALA",
                "prenom" => "Yasmine",
                "password" => Hash::make("123456789"),
                "email" => "candidat@gmail.com",
                "telepho.ne" => 90786260,
                "sexe" => "M"
            ],
            [
                "nom" => "ABOUBAKAR",
                "prenom" => "sakirou",
                "password" => Hash::make("sakirou236"),
                "email" => "secret@gmail.com",
                "telephone" => 91736260,
                "sexe" => "M"
            ],
            [
                "nom" => "BAMASSI",
                "prenom" => "Fadila",
                "password" => Hash::make("236558"),
                "email" => "enseignant@gmail.com",
                "telephone" => 70706260,
                "sexe" => "F"
            ]
        ]);
        
    }
}
