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
        Schema::create('biens_immobiliers', function (Blueprint $table) {
            $table->id();
            $table->string('code_unique', 50)->unique();
            $table->foreignId('proprietaire_id')->constrained('proprietaires');
            $table->string('titre', 200);
            $table->enum('type', ['appartement', 'maison', 'studio', 'villa', 'commerce', 'terrain']);
            $table->text('adresse');
            $table->decimal('surface', 8, 2);
            $table->integer('nombre_pieces');
            $table->decimal('loyer_mensuel', 10, 2);
            $table->decimal('caution', 10, 2);
            $table->enum('statut', ['disponible', 'loue', 'en_maintenance', 'archive'])->default('disponible');
            $table->text('description')->nullable();
            $table->json('equipements')->nullable();
            $table->json('photos')->nullable();
            $table->date('date_disponibilite')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biens_immobiliers');
    }
};
