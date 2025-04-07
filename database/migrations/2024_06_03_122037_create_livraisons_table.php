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
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->double('quantite_livree');
            $table->boolean('annulee')->default(false);
            $table->boolean('geree')->default(false);
            $table->foreignId('system_produit_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('produit_transforme_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('ligne_client_systeme_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livraisons');
    }
};
