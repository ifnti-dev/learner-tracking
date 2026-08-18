<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create.promotion',
            'show.promotion',
            'update.promotion',
            'delete.promotion',

            'create.personne.responsable',
            'show.personne.responsable',
            'update.personne.responsable',
            'delete.personne.responsable',

            'create.apprenant',
            'show.apprenant',
            'update.apprenant',
            'delete.apprenant',

            'inscrire.apprenant',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }   
    }
}
