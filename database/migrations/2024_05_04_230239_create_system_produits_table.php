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
        Schema::create('system_produits', function (Blueprint $table) {
            
            
            $table->id();

            $table->double('qte_stck');
            $table->double('qte_stck_satic_apres_appro');
            $table->double('puv');
            $table->double('nombre_pieces')->default(1);
            $table->double('nombre_portions')->default(1);
            $table->double('pua')->nullable();

            $table->string('portion')->nullable();
            $table->string('nom_piece')->nullable();
            $table->foreignId('system_client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('produit_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_produits');
    }
};
