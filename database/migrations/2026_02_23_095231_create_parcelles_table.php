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
        Schema::create('parcelles', function (Blueprint $table) {
            $table->id();
            $table->string('code_parcelle', 50)->unique();
            $table->foreignId('proprietaire_id')->constrained('proprietaires');
            $table->string('titre_foncier', 100)->unique();
            $table->text('adresse');
            $table->decimal('surface', 10, 2);
            $table->enum('statut_juridique', ['propriete', 'location', 'copropriete']);
            $table->enum('type_terrain', ['residentiel', 'commercial', 'agricole', 'industriel']);
            $table->decimal('prix_achat', 12, 2)->nullable();
            $table->date('date_achat')->nullable();
            $table->decimal('prix_vente', 12, 2)->nullable();
            $table->date('date_vente')->nullable();
            $table->foreignId('acheteur_id')->nullable()->constrained('proprietaires');
            $table->text('description')->nullable();
            $table->json('documents_cadastraux')->nullable();
            $table->json('photos')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelles');
    }
};
