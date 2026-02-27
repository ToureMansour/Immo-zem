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
        Schema::create('locataires', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('telephone', 20);
            $table->string('email', 191)->unique();
            $table->text('adresse');
            $table->string('cni_numero', 50)->unique();
            $table->date('cni_date_delivrance');
            $table->string('cni_lieu_delivrance', 100);
            $table->string('profession', 100)->nullable();
            $table->decimal('salaire_mensuel', 10, 2)->nullable();
            $table->string('personne_reference_nom', 100)->nullable();
            $table->string('personne_reference_telephone', 20)->nullable();
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
        Schema::dropIfExists('locataires');
    }
};
