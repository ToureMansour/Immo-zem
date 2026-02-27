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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string('reference', 50)->unique();
            $table->enum('type_paiement', ['loyer_immo', 'location_moto', 'caution', 'charges']);
            $table->foreignId('contrat_location_id')->nullable()->constrained('contrats_location');
            $table->foreignId('location_moto_id')->nullable()->constrained('locations_motos');
            $table->decimal('montant', 10, 2);
            $table->date('date_paiement');
            $table->date('date_echeance');
            $table->enum('statut', ['paye', 'partiel', 'en_retard', 'impaye'])->default('impaye');
            $table->enum('mode_paiement', ['especes', 'virement', 'mobile_money', 'cheque']);
            $table->string('reference_transaction', 100)->nullable();
            $table->text('notes')->nullable();
            $table->string('chemin_pdf_quittance')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
