<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LocationMoto;
use App\Models\Moto;
use App\Models\Conducteur;

class LocationMotoSeeder extends Seeder
{
    public function run(): void
    {
        // Récupérer les motos et conducteurs existants
        $motos = Moto::all();
        $conducteurs = Conducteur::where('statut', 'actif')->get();

        if ($motos->isEmpty() || $conducteurs->isEmpty()) {
            $this->command->error('Veuillez exécuter MotoSeeder et ConducteurSeeder d\'abord');
            return;
        }

        $locations = [
            [
                'moto_immatriculation' => 'ABJ-1234-CI',
                'conducteur_nom' => 'Koné',
                'type_location' => 'journaliere',
                'duree_jours' => 1,
                'caution' => 10000,
                'acompte' => 5000,
                'kilometrage_depart' => 15000,
                'observations_depart' => 'Moto en bon état, pneus en bon état',
                'statut' => 'en_cours',
                'date_debut' => now()->format('Y-m-d'),
            ],
            [
                'moto_immatriculation' => 'YOP-9012-CI',
                'conducteur_nom' => 'Touré',
                'type_location' => 'hebdomadaire',
                'duree_jours' => 7,
                'caution' => 15000,
                'acompte' => 20000,
                'kilometrage_depart' => 8000,
                'observations_depart' => 'Légères rayures sur le côté droit',
                'statut' => 'en_cours',
                'date_debut' => now()->subDays(2)->format('Y-m-d'),
            ],
            [
                'moto_immatriculation' => 'TRE-3456-CI',
                'conducteur_nom' => 'Ouattara',
                'type_location' => 'mensuelle',
                'duree_jours' => 30,
                'caution' => 20000,
                'acompte' => 50000,
                'kilometrage_depart' => 18000,
                'observations_depart' => 'Excellent état, récente maintenance',
                'statut' => 'en_cours',
                'date_debut' => now()->subDays(5)->format('Y-m-d'),
            ],
            [
                'moto_immatriculation' => 'BAS-2345-CI',
                'conducteur_nom' => 'Sangaré',
                'type_location' => 'credit_bail',
                'duree_jours' => 90,
                'caution' => 25000,
                'acompte' => 100000,
                'kilometrage_depart' => 12000,
                'observations_depart' => 'Nouvelle moto, zéro défaut',
                'statut' => 'en_cours',
                'date_debut' => now()->subDays(10)->format('Y-m-d'),
            ],
            [
                'moto_immatriculation' => 'ABJ-8901-CI',
                'conducteur_nom' => 'Koné',
                'type_location' => 'journaliere',
                'duree_jours' => 1,
                'caution' => 10000,
                'acompte' => 8000,
                'kilometrage_depart' => 20000,
                'observations_depart' => 'Bon état général',
                'kilometrage_retour' => 20050,
                'observations_retour' => 'Retour impeccable, aucun problème',
                'statut' => 'terminee',
                'date_debut' => now()->subDays(1)->format('Y-m-d'),
            ],
            [
                'moto_immatriculation' => 'ABJ-5678-CI',
                'conducteur_nom' => 'Touré',
                'type_location' => 'journaliere',
                'duree_jours' => 1,
                'caution' => 10000,
                'acompte' => 12000,
                'kilometrage_depart' => 22000,
                'observations_depart' => 'État satisfaisant',
                'kilometrage_retour' => 22100,
                'observations_retour' => 'Petite rayure sur le garde-boue',
                'statut' => 'terminee',
                'date_debut' => now()->subDays(3)->format('Y-m-d'),
            ],
        ];

        foreach ($locations as $locationData) {
            $moto = $motos->firstWhere('immatriculation', $locationData['moto_immatriculation']);
            $conducteur = $conducteurs->firstWhere('nom', $locationData['conducteur_nom']);

            if (!$moto || !$conducteur) {
                continue;
            }

            // Calculer le montant total
            $montantTotal = $this->calculerMontantTotal($locationData['type_location'], $locationData['duree_jours'], $moto);
            
            // Calculer la date de fin
            $dateFin = date('Y-m-d', strtotime($locationData['date_debut'] . ' + ' . $locationData['duree_jours'] . ' days'));

            // Générer un numéro de location unique
            $numeroLocation = 'LOC-' . date('Y') . '-' . str_pad(LocationMoto::count() + 1, 4, '0', STR_PAD_LEFT);

            LocationMoto::create([
                'numero_location' => $numeroLocation,
                'moto_id' => $moto->id,
                'conducteur_id' => $conducteur->id,
                'type_location' => $locationData['type_location'],
                'date_debut' => $locationData['date_debut'],
                'date_fin' => $dateFin,
                'duree_jours' => $locationData['duree_jours'],
                'montant_total' => $montantTotal,
                'acompte' => $locationData['acompte'],
                'reste_a_payer' => $montantTotal - $locationData['acompte'],
                'caution' => $locationData['caution'],
                'statut' => $locationData['statut'],
                'kilometrage_depart' => $locationData['kilometrage_depart'],
                'kilometrage_retour' => $locationData['kilometrage_retour'] ?? null,
                'observations_depart' => $locationData['observations_depart'],
                'observations_retour' => $locationData['observations_retour'] ?? null,
            ]);

            // Mettre à jour le statut de la moto si en cours
            if ($locationData['statut'] === 'en_cours') {
                $moto->update(['statut' => 'loue']);
            }
        }

        $this->command->info('Locations de test créées avec succès!');
        $this->command->info('Total: ' . count($locations) . ' locations ajoutées');
    }

    private function calculerMontantTotal($typeLocation, $dureeJours, $moto)
    {
        $prixJournalier = $moto->prix_journalier;

        switch ($typeLocation) {
            case 'journaliere':
                return $prixJournalier * $dureeJours;
            case 'hebdomadaire':
                return $prixJournalier * 7 * $dureeJours;
            case 'mensuelle':
                return $prixJournalier * 30 * $dureeJours;
            case 'credit_bail':
                return $moto->prix_location_vente * $dureeJours;
            default:
                return $prixJournalier * $dureeJours;
        }
    }
}
