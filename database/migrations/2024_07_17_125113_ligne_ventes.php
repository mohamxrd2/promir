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
        Schema::create('ligne_ventes', function (Blueprint $table) {
            $table->id();
            $table->double('quantite_envoyee')->nullable();
            $table->double('quantite_vendue');
            $table->double('prix_vente');
            $table->double('prix_reel_vente')->nullable();
            $table->double('montant_regle');
            $table->string('type_de_produit_a_vendre');
            $table->foreignId('vente_id')->constrained('ventes')->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('system_produit_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('produit_transforme_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ligne_ventes', function (Blueprint $table) {
            $table->dropForeign(['vente_id']);
            $table->dropForeign(['service_id']);
            $table->dropForeign(['system_produit_id']);
            $table->dropForeign(['produit_transforme_id']);
        });
        

        Schema::dropIfExists('ligne_ventes');
    }
};
