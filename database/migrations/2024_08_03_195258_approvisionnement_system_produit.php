<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('approvisionnement_system_produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('approvisionnement_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('system_produit_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('dette_fournisseur_id')->nullable()->constrained()->cascadeOnDelete();
            $table->double(column: 'quantite_entree');
            $table->double('prix_unitaire_achat');
            $table->double('somme_reglee');
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('approvisionnement_system_produits');
    }
};
