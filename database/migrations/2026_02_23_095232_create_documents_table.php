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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('titre', 200);
            $table->enum('type_document', ['contrat_location', 'contrat_moto', 'quittance', 'cni', 'permis', 'carte_grise', 'titre_foncier', 'autre']);
            $table->string('chemin_fichier');
            $table->string('nom_fichier_original');
            $table->string('mime_type');
            $table->integer('taille_fichier');
            $table->morphs('documentable');
            $table->foreignId('uploaded_by')->constrained('users');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
