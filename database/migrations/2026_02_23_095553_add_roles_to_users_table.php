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
        Schema::table('users', function (Blueprint $table) {
            $table->string('telephone', 20)->nullable();
            $table->text('adresse')->nullable();
            $table->string('cni_numero', 50)->nullable();
            $table->date('cni_date_delivrance')->nullable();
            $table->string('cni_lieu_delivrance', 100)->nullable();
            $table->enum('statut', ['actif', 'inactif'])->default('actif');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'adresse', 'cni_numero', 'cni_date_delivrance', 'cni_lieu_delivrance', 'statut']);
            $table->dropSoftDeletes();
        });
    }
};
