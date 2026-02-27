<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BienImmobilier;
use App\Models\Proprietaire;

class BienImmobilierSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer tous les propriétaires existants
        $proprietaires = Proprietaire::all();
        
        if ($proprietaires->isEmpty()) {
            $this->command->warn('Aucun propriétaire trouvé. Veuillez exécuter ProprietaireSeeder d\'abord.');
            return;
        }

        $biens = [
            [
                'code_unique' => 'BIEN001',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Appartement F3 Cocody',
                'type' => 'appartement',
                'adresse' => 'Cocody, Abidjan, Côte d\'Ivoire',
                'surface' => 85.50,
                'nombre_pieces' => 3,
                'loyer_mensuel' => 150000,
                'caution' => 300000,
                'statut' => 'disponible',
                'description' => 'Bel appartement F3 bien situé dans le quartier résidentiel de Cocody. Proche des commerces et écoles.',
                'equipements' => json_encode(['Climatisation', 'Garde-corps', 'Eau courante', 'Électricité']),
                'photos' => json_encode(['bien1_photo1.jpg', 'bien1_photo2.jpg']),
                'date_disponibilite' => now()->addDays(15),
            ],
            [
                'code_unique' => 'BIEN002',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Villa 4 Chambres Riviera',
                'type' => 'maison',
                'adresse' => 'Riviera Palmeraie, Abidjan, Côte d\'Ivoire',
                'surface' => 250.00,
                'nombre_pieces' => 5,
                'loyer_mensuel' => 500000,
                'caution' => 1000000,
                'statut' => 'loue',
                'description' => 'Magnifique villa avec jardin et piscine. Idéale pour les familles.',
                'equipements' => json_encode(['Piscine', 'Jardin', 'Garage', 'Climatisation', 'Gardien']),
                'photos' => json_encode(['bien2_photo1.jpg', 'bien2_photo2.jpg', 'bien2_photo3.jpg']),
                'date_disponibilite' => now()->subMonths(6),
            ],
            [
                'code_unique' => 'BIEN003',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Studio Plateau',
                'type' => 'appartement',
                'adresse' => 'Plateau, Abidjan, Côte d\'Ivoire',
                'surface' => 35.00,
                'nombre_pieces' => 1,
                'loyer_mensuel' => 75000,
                'caution' => 150000,
                'statut' => 'disponible',
                'description' => 'Studio moderne en plein centre ville. Parfait pour les jeunes professionnels.',
                'equipements' => json_encode(['Climatisation', 'Eau chaude', 'Sécurité 24/7']),
                'photos' => json_encode(['bien3_photo1.jpg']),
                'date_disponibilite' => now()->addDays(7),
            ],
            [
                'code_unique' => 'BIEN004',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Bureau Commercial Marcory',
                'type' => 'commerce',
                'adresse' => 'Marcory, Abidjan, Côte d\'Ivoire',
                'surface' => 120.00,
                'nombre_pieces' => 4,
                'loyer_mensuel' => 200000,
                'caution' => 400000,
                'statut' => 'en_maintenance',
                'description' => 'Espace de bureau idéal pour PME. Bien desservi par les transports.',
                'equipements' => json_encode(['Climatisation', 'Parking', 'Sécurité', 'Ascenseur']),
                'photos' => json_encode(['bien4_photo1.jpg', 'bien4_photo2.jpg']),
                'date_disponibilite' => now()->addMonths(2),
            ],
            [
                'code_unique' => 'BIEN005',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Appartement F2 Yopougon',
                'type' => 'appartement',
                'adresse' => 'Yopougon, Abidjan, Côte d\'Ivoire',
                'surface' => 65.00,
                'nombre_pieces' => 2,
                'loyer_mensuel' => 90000,
                'caution' => 180000,
                'statut' => 'disponible',
                'description' => 'Appartement F3 rénové avec balcon. Très bon rapport qualité/prix.',
                'equipements' => json_encode(['Balcon', 'Climatisation', 'Eau courante']),
                'photos' => json_encode(['bien5_photo1.jpg']),
                'date_disponibilite' => now()->addDays(10),
            ],
            [
                'code_unique' => 'BIEN006',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Terrain à Bâtir Grand-Bassam',
                'type' => 'terrain',
                'adresse' => 'Grand-Bassam, Côte d\'Ivoire',
                'surface' => 500.00,
                'nombre_pieces' => 0,
                'loyer_mensuel' => 0,
                'caution' => 0,
                'statut' => 'disponible',
                'description' => 'Terrain viabilisé de 500m², idéal pour construction de villa.',
                'equipements' => json_encode(['Eau courante', 'Électricité', 'Voie d\'accès']),
                'photos' => json_encode(['bien6_photo1.jpg', 'bien6_photo2.jpg']),
                'date_disponibilite' => now(),
            ],
            [
                'code_unique' => 'BIEN007',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Duplex 5 Chambres Abobo',
                'type' => 'maison',
                'adresse' => 'Abobo, Abidjan, Côte d\'Ivoire',
                'surface' => 180.00,
                'nombre_pieces' => 6,
                'loyer_mensuel' => 350000,
                'caution' => 700000,
                'statut' => 'loue',
                'description' => 'Duplex spacieux avec terrasse. Parfait pour grandes familles.',
                'equipements' => json_encode(['Terrasse', 'Climatisation', 'Garage', 'Jardin', 'Gardien']),
                'photos' => json_encode(['bien7_photo1.jpg', 'bien7_photo2.jpg', 'bien7_photo3.jpg']),
                'date_disponibilite' => now()->subMonths(3),
            ],
            [
                'code_unique' => 'BIEN008',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre' => 'Boutique Commerciale Treichville',
                'type' => 'commerce',
                'adresse' => 'Treichville, Abidjan, Côte d\'Ivoire',
                'surface' => 45.00,
                'nombre_pieces' => 1,
                'loyer_mensuel' => 120000,
                'caution' => 240000,
                'statut' => 'disponible',
                'description' => 'Boutique en rez-de-chaussée avec grande vitrine. Idéale pour commerce.',
                'equipements' => json_encode(['Vitrine', 'Toilettes', 'Stationnement']),
                'photos' => json_encode(['bien8_photo1.jpg']),
                'date_disponibilite' => now()->addDays(5),
            ],
        ];

        foreach ($biens as $bien) {
            BienImmobilier::create($bien);
        }

        $this->command->info('Biens immobiliers créés avec succès!');
        $this->command->info('Total: ' . count($biens) . ' biens ajoutés');
    }
}
