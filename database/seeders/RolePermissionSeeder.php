<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $responsableRole = Role::where('name', 'responsable')->first();
        $enseignantRole = Role::where('name', 'enseignant')->first();
        $candidatRole = Role::where('name', 'candidat')->first();
        $secretaireRole = Role::where('name', 'secretaire')->first();

        $responsableRole->syncPermissions(
            Permission::all()
        );

        $secretaireRole->syncPermissions(
            Permission::all()
        );

        $candidatRole->syncPermissions(
            Permission::where('name', 'candidater')->get()
        );

        $enseignantRole->syncPermissions(
            Permission::whereIn('name', ['seance.planifier','seance.view'])->get()
        );
        

    }
}
