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
        Schema::create('locations_motos', function (Blueprint $table) {
            $table->id();
            $table->string('numero_location', 50)->unique();
            $table->foreignId('moto_id')->constrained('motos');
            $table->foreignId('conducteur_id')->constrained('conducteurs');
            $table->enum('type_location', ['journaliere', 'avec_credit', 'location_vente']);
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->integer('duree_jours')->nullable();
            $table->decimal('montant_total', 10, 2);
            $table->decimal('acompte', 10, 2)->default(0);
            $table->decimal('reste_a_payer', 10, 2);
            $table->decimal('caution', 10, 2);
            $table->enum('statut', ['en_cours', 'terminee', 'annulee', 'suspendue'])->default('en_cours');
            $table->integer('kilometrage_depart')->default(0);
            $table->integer('kilometrage_retour')->nullable();
            $table->text('observations_depart')->nullable();
            $table->text('observations_retour')->nullable();
            $table->string('chemin_pdf_contrat')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations_motos');
    }
};
