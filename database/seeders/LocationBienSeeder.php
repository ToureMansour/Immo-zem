<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LocationBien;
use App\Models\BienImmobilier;
use App\Models\Proprietaire;

class LocationBienSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les biens et propriétaires existants
        $biens = BienImmobilier::all();
        $proprietaires = Proprietaire::all();

        if ($biens->isEmpty() || $proprietaires->count() < 2) {
            $this->command->error('Pas assez de biens ou de propriétaires pour créer des locations de test');
            return;
        }

        $locations = [
            [
                'bien_code' => 'APP-001',
                'proprietaire_nom' => 'Koné',
                'locataire_nom' => 'Touré',
                'type_bail' => 'habitation',
                'duree_mois' => 12,
                'montant_loyer_mensuel' => 50000,
                'charges_mensuelles' => 5000,
                'depot_garantie' => 100000,
                'loyer_premier_mois' => 55000,
                'observations_entree' => 'Appartement en bon état, cuisine équipée, climatisation fonctionnelle',
                'etat_lieux_entre' => ['murs' => 'bons', 'sol' => 'bons', 'plomberie' => 'fonctionnelle', 'electricite' => 'fonctionnelle'],
                'statut' => 'en_cours',
                'date_debut' => now()->format('Y-m-d'),
            ],
            [
                'bien_code' => 'APP-002',
                'proprietaire_nom' => 'Ouattara',
                'locataire_nom' => 'Sangaré',
                'type_bail' => 'commercial',
                'duree_mois' => 24,
                'montant_loyer_mensuel' => 75000,
                'charges_mensuelles' => 7500,
                'depot_garantie' => 150000,
                'loyer_premier_mois' => 82500,
                'observations_entree' => 'Local commercial bien situé, vitrine principale, parking inclus',
                'etat_lieux_entre' => ['murs' => 'bons', 'sol' => 'bons', 'plomberie' => 'fonctionnelle', 'electricite' => 'fonctionnelle'],
                'statut' => 'en_cours',
                'date_debut' => now()->subMonths(2)->format('Y-m-d'),
            ],
            [
                'bien_code' => 'APP-003',
                'proprietaire_nom' => 'Bamba',
                'locataire_nom' => 'Koné',
                'type_bail' => 'habitation',
                'duree_mois' => 36,
                'montant_loyer_mensuel' => 45000,
                'charges_mensuelles' => 4500,
                'depot_garantie' => 90000,
                'loyer_premier_mois' => 49500,
                'observations_entree' => 'Appartement T3, bon état général, quartier calme',
                'etat_lieux_entre' => ['murs' => 'bons', 'sol' => 'bons', 'plomberie' => 'fonctionnelle', 'electricite' => 'fonctionnelle'],
                'statut' => 'en_cours',
                'date_debut' => now()->subMonths(6)->format('Y-m-d'),
            ],
            [
                'bien_code' => 'APP-004',
                'proprietaire_nom' => 'Sangaré',
                'locataire_nom' => 'Bamba',
                'type_bail' => 'professionnel',
                'duree_mois' => 48,
                'montant_loyer_mensuel' => 120000,
                'charges_mensuelles' => 12000,
                'depot_garantie' => 200000,
                'loyer_premier_mois' => 132000,
                'observations_entree' => 'Bureau professionnel, climatisation, bonne localisation',
                'etat_lieux_entre' => ['murs' => 'bons', 'sol' => 'bons', 'plomberie' => 'fonctionnelle', 'electricite' => 'fonctionnelle'],
                'statut' => 'en_cours',
                'date_debut' => now()->subMonths(4)->format('Y-m-d'),
            ],
            [
                'bien_code' => 'APP-005',
                'proprietaire_nom' => 'Koné',
                'locataire_nom' => 'Ouattara',
                'type_bail' => 'meuble',
                'duree_mois' => 6,
                'montant_loyer_mensuel' => 35000,
                'charges_mensuelles' => 3500,
                'depot_garantie' => 70000,
                'loyer_premier_mois' => 38500,
                'observations_entree' => 'Studio meublé, équipé, bien entretenu',
                'etat_lieux_entre' => ['murs' => 'bons', 'sol' => 'bons', 'plomberie' => 'fonctionnelle', 'electricite' => 'fonctionnelle'],
                'statut' => 'terminee',
                'date_debut' => now()->subMonths(12)->format('Y-m-d'),
                'date_fin' => now()->subMonths(6)->format('Y-m-d'),
                'observations_sortie' => 'Studio en bon état, aucun dégât constaté',
                'etat_lieux_sortie' => ['murs' => 'bons', 'sol' => 'bons', 'plomberie' => 'fonctionnelle', 'electricite' => 'fonctionnelle'],
            ],
            [
                'bien_code' => 'APP-006',
                'proprietaire_nom' => 'Touré',
                'locataire_nom' => 'Bamba',
                'type_bail' => 'non_meuble',
                'duree_mois' => 18,
                'montant_loyer_mensuel' => 80000,
                'charges_mensuelles' => 8000,
                'depot_garantie' => 160000,
                'loyer_premier_mois' => 88000,
                'observations_entree' => 'Appartement F4, récemment rénové, belle vue',
                'etat_lieux_entre' => ['murs' => 'bons', 'sol' => 'bons', 'plomberie' => 'fonctionnelle', 'electricite' => 'fonctionnelle'],
                'statut' => 'en_cours',
                'date_debut' => now()->subMonths(1)->format('Y-m-d'),
            ],
        ];

        foreach ($locations as $locationData) {
            $bien = $biens->firstWhere('code_unique', $locationData['bien_code']);
            $proprietaire = $proprietaires->firstWhere('nom', $locationData['proprietaire_nom']);
            $locataire = $proprietaires->firstWhere('nom', $locationData['locataire_nom']);

            if (!$bien || !$proprietaire || !$locataire) {
                continue;
            }

            // Calculer la date de fin
            $dateFin = date('Y-m-d', strtotime($locationData['date_debut'] . ' + ' . $locationData['duree_mois'] . ' months'));

            // Générer un numéro de location unique
            $numeroLocation = 'LOC-B-' . date('Y') . '-' . str_pad(LocationBien::count() + 1, 4, '0', STR_PAD_LEFT);

            LocationBien::create([
                'numero_location' => $numeroLocation,
                'bien_immobilier_id' => $bien->id,
                'locataire_id' => $locataire->id,
                'proprietaire_id' => $proprietaire->id,
                'type_bail' => $locationData['type_bail'],
                'duree_mois' => $locationData['duree_mois'],
                'date_debut' => $locationData['date_debut'],
                'date_fin' => $dateFin,
                'montant_loyer_mensuel' => $locationData['montant_loyer_mensuel'],
                'charges_mensuelles' => $locationData['charges_mensuelles'],
                'depot_garantie' => $locationData['depot_garantie'],
                'montant_total_garantie' => $locationData['depot_garantie'] + $locationData['loyer_premier_mois'],
                'loyer_premier_mois' => $locationData['loyer_premier_mois'],
                'statut' => $locationData['statut'],
                'observations_entree' => $locationData['observations_entree'],
                'observations_sortie' => $locationData['observations_sortie'] ?? null,
                'etat_lieux_entre' => $locationData['etat_lieux_entre'] ?? [],
                'etat_lieux_sortie' => $locationData['etat_lieux_sortie'] ?? [],
                'date_fin' => $locationData['date_fin'] ?? null,
            ]);

            // Mettre à jour le statut du bien si terminée
            if ($locationData['statut'] === 'terminee') {
                $bien->update(['statut' => 'disponible']);
            }
        }

        $this->command->info('Locations de biens de test créées avec succès!');
        $this->command->info('Total: ' . count($locations) . ' locations ajoutées');
    }
}
