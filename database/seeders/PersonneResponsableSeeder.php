<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\Type;
class PersonneResponsableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('personne_responsables')->insert([
            [
                'nom'        => 'Diallo',
                'prenom'     => 'Ousmane',
                'telephone'  => '770100001',
                'type'       => Type::PERE->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom'        => 'Ndiaye',
                'prenom'     => 'Aïssatou',
                'telephone'  => '770100002',
                'type'       => Type::MERE->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom'        => 'Ba',
                'prenom'     => 'Mamadou',
                'telephone'  => '770100003',
                'type'       => Type::TUTEURE->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nom'        => 'Sarr',
                'prenom'     => 'Khady',
                'telephone'  => '770100004',
                'type'       => Type::MERE->value,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        echo "personne_responsable seeder";
    }
}
