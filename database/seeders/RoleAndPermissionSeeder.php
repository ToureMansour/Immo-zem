<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création des permissions
        $permissions = [
            // Gestion immobilière
            'proprietaires.view',
            'proprietaires.create',
            'proprietaires.edit',
            'proprietaires.delete',
            
            'biens.view',
            'biens.create',
            'biens.edit',
            'biens.delete',
            
            'locataires.view',
            'locataires.create',
            'locataires.edit',
            'locataires.delete',
            
            'contrats.view',
            'contrats.create',
            'contrats.edit',
            'contrats.delete',
            
            // Gestion motos
            'motos.view',
            'motos.create',
            'motos.edit',
            'motos.delete',
            
            'conducteurs.view',
            'conducteurs.create',
            'conducteurs.edit',
            'conducteurs.delete',
            
            'locations-motos.view',
            'locations-motos.create',
            'locations-motos.edit',
            'locations-motos.delete',
            
            // Gestion financière
            'paiements.view',
            'paiements.create',
            'paiements.edit',
            'paiements.delete',
            
            // Gestion parcelles
            'parcelles.view',
            'parcelles.create',
            'parcelles.edit',
            'parcelles.delete',
            
            // Administration
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
            
            'dashboard.view',
            'reports.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Création des rôles
        $adminRole = Role::firstOrCreate(['name' => 'Administrateur']);
        $managerRole = Role::firstOrCreate(['name' => 'Manager']);
        $consultantRole = Role::firstOrCreate(['name' => 'Consultant']);

        // Attribution des permissions aux rôles
        $adminRole->givePermissionTo(Permission::all());

        $managerRole->givePermissionTo([
            'proprietaires.view', 'proprietaires.create', 'proprietaires.edit',
            'biens.view', 'biens.create', 'biens.edit',
            'locataires.view', 'locataires.create', 'locataires.edit',
            'contrats.view', 'contrats.create', 'contrats.edit',
            'motos.view', 'motos.create', 'motos.edit',
            'conducteurs.view', 'conducteurs.create', 'conducteurs.edit',
            'locations-motos.view', 'locations-motos.create', 'locations-motos.edit',
            'paiements.view', 'paiements.create', 'paiements.edit',
            'parcelles.view', 'parcelles.create', 'parcelles.edit',
            'dashboard.view',
            'reports.view',
        ]);

        $consultantRole->givePermissionTo([
            'proprietaires.view',
            'biens.view',
            'locataires.view',
            'contrats.view',
            'motos.view',
            'conducteurs.view',
            'locations-motos.view',
            'paiements.view',
            'parcelles.view',
            'dashboard.view',
            'reports.view',
        ]);

        $this->command->info('Rôles et permissions créés avec succès!');
    }
}
