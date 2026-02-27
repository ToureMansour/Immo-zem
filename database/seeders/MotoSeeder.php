<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Moto;

class MotoSeeder extends Seeder
{
    public function run(): void
    {
        $motos = [
            [
                'immatriculation' => 'ABJ-1234-CI',
                'marque' => 'Honda',
                'modele' => 'CG 125',
                'annee' => 2022,
                'couleur' => 'Rouge',
                'type_moto' => 'taxi',
                'prix_journalier' => 10000,
                'prix_avec_credit' => 15000,
                'prix_location_vente' => 20000,
                'statut' => 'disponible',
                'kilometrage' => 15000,
                'date_derniere_maintenance' => now()->subMonths(2),
                'description' => 'Moto taxi en excellent état, très économique en carburant. Idéale pour service urbain.',
                'photos' => json_encode(['moto1_photo1.jpg', 'moto1_photo2.jpg']),
                'carte_grise_numero' => 'CG-ABJ-123456',
                'carte_grise_delivrance' => now()->subYears(2),
            ],
            [
                'immatriculation' => 'ABJ-5678-CI',
                'marque' => 'Yamaha',
                'modele' => 'MT-07',
                'annee' => 2021,
                'couleur' => 'Bleu',
                'type_moto' => 'taxi',
                'prix_journalier' => 12000,
                'prix_avec_credit' => 18000,
                'prix_location_vente' => 25000,
                'statut' => 'loue',
                'kilometrage' => 22000,
                'date_derniere_maintenance' => now()->subMonths(1),
                'description' => 'Moto Yamaha MT-07, puissance et fiabilité au rendez-vous. Parfaite pour longues distances.',
                'photos' => json_encode(['moto2_photo1.jpg']),
                'carte_grise_numero' => 'CG-ABJ-567890',
                'carte_grise_delivrance' => now()->subYears(3),
            ],
            [
                'immatriculation' => 'YOP-9012-CI',
                'marque' => 'Kawasaki',
                'modele' => 'Ninja 250',
                'annee' => 2023,
                'couleur' => 'Noir',
                'type_moto' => 'personnel',
                'prix_journalier' => 8000,
                'prix_avec_credit' => 12000,
                'prix_location_vente' => 15000,
                'statut' => 'disponible',
                'kilometrage' => 8000,
                'date_derniere_maintenance' => now()->subWeeks(1),
                'description' => 'Moto sportive Kawasaki Ninja 250, très peu utilisée. Moteur puissant et entretenu régulièrement.',
                'photos' => json_encode(['moto3_photo1.jpg', 'moto3_photo2.jpg', 'moto3_photo3.jpg']),
                'carte_grise_numero' => 'CG-YOP-901234',
                'carte_grise_delivrance' => now()->subMonths(6),
            ],
            [
                'immatriculation' => 'TRE-3456-CI',
                'marque' => 'Suzuki',
                'modele' => 'Address',
                'annee' => 2020,
                'couleur' => 'Vert',
                'type_moto' => 'livraison',
                'prix_journalier' => 9000,
                'prix_avec_credit' => 14000,
                'prix_location_vente' => 18000,
                'statut' => 'disponible',
                'kilometrage' => 18000,
                'date_derniere_maintenance' => now()->subMonths(3),
                'description' => 'Moto Suzuki Address, parfaite pour livraisons rapides. Boîte automatique et faible consommation.',
                'photos' => json_encode(['moto4_photo1.jpg']),
                'carte_grise_numero' => 'CG-TRE-345678',
                'carte_grise_delivrance' => now()->subYears(4),
            ],
            [
                'immatriculation' => 'ABJ-7890-CI',
                'marque' => 'Piaggio',
                'modele' => 'Zip',
                'annee' => 2022,
                'couleur' => 'Blanc',
                'type_moto' => 'taxi',
                'prix_journalier' => 11000,
                'prix_avec_credit' => 16000,
                'prix_location_vente' => 22000,
                'statut' => 'reparation',
                'kilometrage' => 35000,
                'date_derniere_maintenance' => now()->subDays(5),
                'description' => 'Moto Piaggio Zip en maintenance pour révision complète du moteur et changement des pneus.',
                'photos' => json_encode(['moto5_photo1.jpg']),
                'carte_grise_numero' => 'CG-ABJ-789012',
                'carte_grise_delivrance' => now()->subYears(2),
            ],
            [
                'immatriculation' => 'BAS-2345-CI',
                'marque' => 'TVS',
                'modele' => 'Apache RTR 160',
                'annee' => 2023,
                'couleur' => 'Gris',
                'type_moto' => 'taxi',
                'prix_journalier' => 9500,
                'prix_avec_credit' => 14000,
                'prix_location_vente' => 19000,
                'statut' => 'disponible',
                'kilometrage' => 12000,
                'date_derniere_maintenance' => now()->subMonths(4),
                'description' => 'Moto TVS Apache, style indien avec fiabilité éprouvée. Très bon rapport qualité/prix.',
                'photos' => json_encode(['moto6_photo1.jpg', 'moto6_photo2.jpg']),
                'carte_grise_numero' => 'CG-BAS-234567',
                'carte_grise_delivrance' => now()->subMonths(8),
            ],
            [
                'immatriculation' => 'ABJ-8901-CI',
                'marque' => 'Bajaj',
                'modele' => 'Pulsar 150',
                'annee' => 2022,
                'couleur' => 'Bleu marine',
                'type_moto' => 'taxi',
                'prix_journalier' => 10500,
                'prix_avec_credit' => 15500,
                'prix_location_vente' => 21000,
                'statut' => 'disponible',
                'kilometrage' => 20000,
                'date_derniere_maintenance' => now()->subWeeks(2),
                'description' => 'Moto Bajaj Pulsar, design moderne et bonne tenue de route. Équipée pour service taxi.',
                'photos' => json_encode(['moto8_photo1.jpg', 'moto8_photo2.jpg']),
                'carte_grise_numero' => 'CG-ABJ-890123',
                'carte_grise_delivrance' => now()->subMonths(10),
            ],
        ];

        foreach ($motos as $moto) {
            Moto::create($moto);
        }

        $this->command->info('Motos de test créées avec succès!');
        $this->command->info('Total: ' . count($motos) . ' motos ajoutées');
    }
}
