<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations_biens', function (Blueprint $table) {
            $table->id();
            $table->string('numero_location', 50)->unique();
            $table->foreignId('bien_immobilier_id')->constrained('biens_immobiliers')->onDelete('cascade');
            $table->foreignId('locataire_id')->constrained('proprietaires')->onDelete('cascade');
            $table->foreignId('proprietaire_id')->constrained('proprietaires')->onDelete('cascade');
            $table->enum('type_bail', ['habitation', 'commercial', 'professionnel', 'meuble', 'non_meuble']);
            $table->integer('duree_mois');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('montant_loyer_mensuel', 10, 2);
            $table->decimal('charges_mensuelles', 10, 2)->default(0);
            $table->decimal('depot_garantie', 10, 2);
            $table->decimal('montant_total_garantie', 10, 2);
            $table->decimal('loyer_premier_mois', 10, 2);
            $table->enum('statut', ['en_attente', 'en_cours', 'terminee', 'resiliee'])->default('en_attente');
            $table->date('date_derniere_paiement')->nullable();
            $table->decimal('montant_dernier_paiement', 10, 2)->nullable();
            $table->text('observations_entree')->nullable();
            $table->text('observations_sortie')->nullable();
            $table->json('etat_lieux_entree')->nullable();
            $table->json('etat_lieux_sortie')->nullable();
            $table->string('chemin_pdf_contrat')->nullable();
            $table->date('date_resiliation')->nullable();
            $table->text('motif_resiliation')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations_biens');
    }
};
