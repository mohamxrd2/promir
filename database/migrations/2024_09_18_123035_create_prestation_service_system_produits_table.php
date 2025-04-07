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
        Schema::create('prestation_service_system_produits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_produit_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('prestation_service_id')->nullable()->constrained()->cascadeOnDelete();
            $table->double('quantite');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestation_service_system_produits');
    }
};
