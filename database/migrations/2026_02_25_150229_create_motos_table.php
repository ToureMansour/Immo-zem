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
        Schema::create('motos', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation', 50)->unique();
            $table->string('marque', 100);
            $table->string('modele', 100);
            $table->integer('annee');
            $table->string('couleur', 50);
            $table->enum('type_moto', ['taxi', 'personnel', 'livraison']);
            $table->decimal('prix_journalier', 8, 2);
            $table->decimal('prix_avec_credit', 8, 2);
            $table->decimal('prix_location_vente', 8, 2);
            $table->enum('statut', ['disponible', 'loue', 'reparation', 'hors_service']);
            $table->integer('kilometrage');
            $table->date('date_derniere_maintenance')->nullable();
            $table->text('description')->nullable();
            $table->json('photos')->nullable();
            $table->string('carte_grise_numero', 50)->unique();
            $table->date('carte_grise_delivrance');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motos');
    }
};
