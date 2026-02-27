<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Parcelle;
use App\Models\Proprietaire;

class ParcelleSeeder extends Seeder
{
    public function run(): void
    {
        $proprietaires = Proprietaire::all();
        
        if ($proprietaires->isEmpty()) {
            $this->command->warn('Aucun propriétaire trouvé. Veuillez exécuter ProprietaireSeeder d\'abord.');
            return;
        }

        $parcelles = [
            [
                'code_parcelle' => 'PAR001',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-ABJ-2023-001',
                'adresse' => 'Cocody, Abidjan, Côte d\'Ivoire',
                'surface' => 500.00,
                'statut_juridique' => 'propriete',
                'type_terrain' => 'residentiel',
                'prix_achat' => 5000000,
                'date_achat' => now()->subYears(2),
                'description' => 'Parcelle résidentielle bien située dans le quartier huppé de Cocody. Idéale pour construction villa.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Plan cadastral', 'Certificat de propriété']),
                'photos' => json_encode(['parcelle1_photo1.jpg', 'parcelle1_photo2.jpg']),
            ],
            [
                'code_parcelle' => 'PAR002',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-YPG-2022-045',
                'adresse' => 'Yopougon, Abidjan, Côte d\'Ivoire',
                'surface' => 750.50,
                'statut_juridique' => 'propriete',
                'type_terrain' => 'commercial',
                'prix_achat' => 8000000,
                'date_achat' => now()->subYears(3),
                'description' => 'Terrain commercial à fort potentiel. Proche des axes routiers principaux et zones commerciales.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Permis de construire', 'Déclaration d\'impôt']),
                'photos' => json_encode(['parcelle2_photo1.jpg']),
            ],
            [
                'code_parcelle' => 'PAR003',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-MRC-2021-089',
                'adresse' => 'Marcory, Abidjan, Côte d\'Ivoire',
                'surface' => 1200.00,
                'statut_juridique' => 'location',
                'type_terrain' => 'agricole',
                'prix_achat' => 3000000,
                'date_achat' => now()->subYears(4),
                'description' => 'Terrain agricole fertile, parfait pour culture maraîchère. Accès facile et source d\'eau à proximité.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Plan cadastral']),
                'photos' => json_encode(['parcelle3_photo1.jpg', 'parcelle3_photo2.jpg', 'parcelle3_photo3.jpg']),
            ],
            [
                'code_parcelle' => 'PAR004',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-TRV-2023-012',
                'adresse' => 'Treichville, Abidjan, Côte d\'Ivoire',
                'surface' => 300.75,
                'statut_juridique' => 'propriete',
                'type_terrain' => 'industriel',
                'prix_achat' => 12000000,
                'date_achat' => now()->subYear(),
                'description' => 'Zone industrielle avec toutes les commodités. Idéale pour petite usine ou entrepôt.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Permis de construire', 'Acte de vente', 'Déclaration d\'impôt']),
                'photos' => json_encode(['parcelle4_photo1.jpg']),
            ],
            [
                'code_parcelle' => 'PAR005',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-PLT-2020-156',
                'adresse' => 'Plateau, Abidjan, Côte d\'Ivoire',
                'surface' => 250.00,
                'statut_juridique' => 'copropriete',
                'type_terrain' => 'residentiel',
                'prix_achat' => 15000000,
                'date_achat' => now()->subYears(5),
                'prix_vente' => 20000000,
                'date_vente' => now()->subMonths(6),
                'acheteur_id' => $proprietaires->random()->id,
                'description' => 'Parcelle en copropriété au centre-ville. Bien desservie par les transports et commerces.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Plan cadastral', 'Certificat de propriété', 'Acte de vente']),
                'photos' => json_encode(['parcelle5_photo1.jpg', 'parcelle5_photo2.jpg']),
            ],
            [
                'code_parcelle' => 'PAR006',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-ABO-2023-078',
                'adresse' => 'Abobo, Abidjan, Côte d\'Ivoire',
                'surface' => 600.25,
                'statut_juridique' => 'propriete',
                'type_terrain' => 'residentiel',
                'prix_achat' => 4500000,
                'date_achat' => now()->subMonths(8),
                'description' => 'Terrain résidentiel en développement. Quartier calme avec écoles et marchés à proximité.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Plan cadastral']),
                'photos' => json_encode(['parcelle6_photo1.jpg']),
            ],
            [
                'code_parcelle' => 'PAR007',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-GBS-2022-034',
                'adresse' => 'Grand-Bassam, Côte d\'Ivoire',
                'surface' => 2000.00,
                'statut_juridique' => 'propriete',
                'type_terrain' => 'agricole',
                'prix_achat' => 5000000,
                'date_achat' => now()->subYears(2),
                'description' => 'Grande parcelle agricole idéale pour plantation. Sol fertile et accès à l\'eau.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Plan cadastral', 'Certificat de propriété']),
                'photos' => json_encode(['parcelle7_photo1.jpg', 'parcelle7_photo2.jpg']),
            ],
            [
                'code_parcelle' => 'PAR008',
                'proprietaire_id' => $proprietaires->random()->id,
                'titre_foncier' => 'TF-ABJ-2021-099',
                'adresse' => 'Bingerville, Abidjan, Côte d\'Ivoire',
                'surface' => 450.00,
                'statut_juridique' => 'propriete',
                'type_terrain' => 'residentiel',
                'prix_achat' => 6000000,
                'date_achat' => now()->subYears(3),
                'description' => 'Parcelle résidentielle dans zone en expansion. Projet urbain prometteur dans le secteur.',
                'documents_cadastraux' => json_encode(['Titre foncier', 'Permis de construire', 'Déclaration d\'impôt']),
                'photos' => json_encode(['parcelle8_photo1.jpg']),
            ],
        ];

        foreach ($parcelles as $parcelle) {
            Parcelle::create($parcelle);
        }

        $this->command->info('Parcelles de test créées avec succès!');
        $this->command->info('Total: ' . count($parcelles) . ' parcelles ajoutées');
    }
}
