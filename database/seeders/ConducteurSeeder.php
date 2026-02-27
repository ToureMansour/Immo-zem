<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conducteur;
use App\Models\LocationMoto;
use App\Models\Moto;

class ConducteurSeeder extends Seeder
{
    public function run(): void
    {
        $conducteurs = [
            [
                'nom' => 'Koné',
                'prenom' => 'Mamadou',
                'telephone' => '+225 07 01 23 45 67',
                'email' => 'kone.mamadou@email.com',
                'adresse' => 'Abidjan, Cocody',
                'cni_numero' => 'CI1234567890123',
                'cni_date_delivrance' => '2022-01-15',
                'cni_lieu_delivrance' => 'Abidjan',
                'permis_numero' => 'P987654321',
                'permis_date_delivrance' => '2021-06-20',
                'permis_lieu_delivrance' => 'Abidjan',
                'permis_expiration' => '2026-06-20',
                'statut' => 'actif',
                'notes' => 'Conducteur expérimenté, très fiable',
            ],
            [
                'nom' => 'Touré',
                'prenom' => 'Awa',
                'telephone' => '+225 07 02 34 56 78',
                'email' => 'ture.awa@email.com',
                'adresse' => 'Abidjan, Yopougon',
                'cni_numero' => 'CI2345678901234',
                'cni_date_delivrance' => '2021-03-10',
                'cni_lieu_delivrance' => 'Bouaké',
                'permis_numero' => 'P876543210',
                'permis_date_delivrance' => '2020-09-15',
                'permis_lieu_delivrance' => 'Abidjan',
                'permis_expiration' => '2025-09-15',
                'statut' => 'actif',
                'notes' => 'Conductrice sérieuse, ponctuelle',
            ],
            [
                'nom' => 'Ouattara',
                'prenom' => 'Ibrahim',
                'telephone' => '+225 07 03 45 67 89',
                'email' => 'ouattara.ibrahim@email.com',
                'adresse' => 'Abidjan, Treichville',
                'cni_numero' => 'CI3456789012345',
                'cni_date_delivrance' => '2023-02-28',
                'cni_lieu_delivrance' => 'Abidjan',
                'permis_numero' => 'P765432109',
                'permis_date_delivrance' => '2022-11-01',
                'permis_lieu_delivrance' => 'Abidjan',
                'permis_expiration' => '2027-11-01',
                'statut' => 'actif',
                'notes' => 'Jeune conducteur motivé',
            ],
            [
                'nom' => 'Bamba',
                'prenom' => 'Fatoumata',
                'telephone' => '+225 07 04 56 78 90',
                'email' => 'bamba.fatou@email.com',
                'adresse' => 'Abidjan, Marcory',
                'cni_numero' => 'CI4567890123456',
                'cni_date_delivrance' => '2020-07-12',
                'cni_lieu_delivrance' => 'Abidjan',
                'permis_numero' => 'P654321098',
                'permis_date_delivrance' => '2019-04-30',
                'permis_lieu_delivrance' => 'Abidjan',
                'permis_expiration' => '2024-04-30',
                'statut' => 'inactif',
                'notes' => 'En pause pour raisons personnelles',
            ],
            [
                'nom' => 'Sangaré',
                'prenom' => 'Bakary',
                'telephone' => '+225 07 05 67 89 01',
                'email' => 'sangare.bakary@email.com',
                'adresse' => 'Abidjan, Plateau',
                'cni_numero' => 'CI5678901234567',
                'cni_date_delivrance' => '2022-09-05',
                'cni_lieu_delivrance' => 'Abidjan',
                'permis_numero' => 'P543210987',
                'permis_date_delivrance' => '2021-12-20',
                'permis_lieu_delivrance' => 'Abidjan',
                'permis_expiration' => '2026-12-20',
                'statut' => 'actif',
                'notes' => 'Conducteur de nuit disponible',
            ],
        ];

        foreach ($conducteurs as $conducteur) {
            Conducteur::create($conducteur);
        }

        $this->command->info('Conducteurs de test créés avec succès!');
        $this->command->info('Total: ' . count($conducteurs) . ' conducteurs ajoutés');
    }
}
