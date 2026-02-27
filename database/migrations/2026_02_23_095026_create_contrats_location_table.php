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
        Schema::create('contrats_location', function (Blueprint $table) {
            $table->id();
            $table->string('numero_contrat', 50)->unique();
            $table->foreignId('bien_immobilier_id')->constrained('biens_immobiliers');
            $table->foreignId('locataire_id')->constrained('locataires');
            $table->foreignId('proprietaire_id')->constrained('proprietaires');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->decimal('loyer_mensuel', 10, 2);
            $table->decimal('caution', 10, 2);
            $table->decimal('charges_mensuelles', 10, 2)->default(0);
            $table->enum('frequence_paiement', ['mensuel', 'trimestriel', 'semestriel', 'annuel'])->default('mensuel');
            $table->enum('statut', ['actif', 'termine', 'suspendu', 'resilie'])->default('actif');
            $table->text('clauses_particulieres')->nullable();
            $table->string('chemin_pdf_contrat')->nullable();
            $table->date('date_signature')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats_location');
    }
};
