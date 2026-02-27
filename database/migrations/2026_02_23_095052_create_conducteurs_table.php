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
        Schema::create('conducteurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('telephone', 20);
            $table->string('email', 191)->unique();
            $table->text('adresse');
            $table->string('cni_numero', 50)->unique();
            $table->date('cni_date_delivrance');
            $table->string('cni_lieu_delivrance', 100);
            $table->string('permis_numero', 50)->unique();
            $table->date('permis_date_delivrance');
            $table->string('permis_lieu_delivrance', 100);
            $table->date('permis_expiration');
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conducteurs');
    }
};
