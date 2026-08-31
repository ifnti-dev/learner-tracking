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
        
            'create.personne.responsable',
            'view.personne.responsable',
            'update.personne.responsable',
            'delete.personne.responsable',

            'create.apprenant',
            'view.apprenant',
            'update.apprenant',
            'delete.apprenant',

            'appouver.candidat',
            'view.candidat',
            'rejeter.candidat',
            'candidater',

            'promotion.create',
            'promotion.view',
            'promotion.update',
            'promotion.destroy',
            
            'seance.planifier',
            'seance.view',
            'seance.gerer.absence',
            'seance.update',

            
            
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }   
    }
}
