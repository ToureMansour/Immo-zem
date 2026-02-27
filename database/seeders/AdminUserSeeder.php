<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate([
            'email' => 'admin@llb-gestion.com',
        ], [
            'name' => 'Administrateur LLB',
            'password' => bcrypt('password123'),
            'telephone' => '+225 07 00 00 00 00',
            'adresse' => 'Abidjan, Côte d\'Ivoire',
            'cni_numero' => 'CI1234567890123',
            'cni_date_delivrance' => '2023-01-15',
            'cni_lieu_delivrance' => 'Abidjan',
            'statut' => 'actif',
            'email_verified_at' => now(),
        ]);

        $admin->assignRole('Administrateur');

        $this->command->info('Utilisateur administrateur créé avec succès!');
        $this->command->info('Email: admin@llb-gestion.com');
        $this->command->info('Mot de passe: password123');
    }
}
