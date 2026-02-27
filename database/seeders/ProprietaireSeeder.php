<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proprietaire;

class ProprietaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proprietaires = [
            [
                'nom' => 'Koffi Jean-Baptiste',
                'email' => 'koffi.jb@email.com',
                'telephone' => '+225 07 89 12 34 56',
                'adresse' => 'Cocody, Abidjan, Côte d\'Ivoire',
                'statut' => 'actif',
                'cni_numero' => 'CI1234567890123',
                'cni_date_delivrance' => '2020-05-15',
                'cni_lieu_delivrance' => 'Abidjan',
            ],
            [
                'nom' => 'Touré Aminata',
                'email' => 'toure.amina@email.com',
                'telephone' => '+225 05 67 89 01 23',
                'adresse' => 'Yopougon, Abidjan, Côte d\'Ivoire',
                'statut' => 'actif',
                'cni_numero' => 'CI9876543210987',
                'cni_date_delivrance' => '2019-11-20',
                'cni_lieu_delivrance' => 'Bouaké',
            ],
            [
                'nom' => 'Koné Mamadou',
                'email' => 'kone.mamadou@email.com',
                'telephone' => '+225 01 23 45 67 89',
                'adresse' => 'Plateau, Abidjan, Côte d\'Ivoire',
                'statut' => 'inactif',
                'cni_numero' => 'CI4567890123456',
                'cni_date_delivrance' => '2021-03-10',
                'cni_lieu_delivrance' => 'Man',
            ],
            [
                'nom' => 'Sangaré Fatou',
                'email' => 'sangare.fatou@email.com',
                'telephone' => '+225 07 45 78 90 12',
                'adresse' => 'Marcory, Abidjan, Côte d\'Ivoire',
                'statut' => 'actif',
                'cni_numero' => 'CI7890123456789',
                'cni_date_delivrance' => '2018-07-25',
                'cni_lieu_delivrance' => 'Korhogo',
            ],
            [
                'nom' => 'Bamba Youssef',
                'email' => 'bamba.youssef@email.com',
                'telephone' => '+225 08 90 12 34 56',
                'adresse' => 'Treichville, Abidjan, Côte d\'Ivoire',
                'statut' => 'actif',
                'cni_numero' => 'CI3456789012345',
                'cni_date_delivrance' => '2022-01-08',
                'cni_lieu_delivrance' => 'Daloa',
            ],
        ];

        foreach ($proprietaires as $proprietaire) {
            Proprietaire::create($proprietaire);
        }

        $this->command->info('Propriétaires de test créés avec succès!');
    }
}
