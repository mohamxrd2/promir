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
        Schema::create('produit_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ligne_vente_id')->constrained()->cascadeOnDelete();
            $table->foreignId('system_produit_id')->constrained()->cascadeOnDelete();
            $table->double('quantite_produit')->default(1.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_services');
    }
};