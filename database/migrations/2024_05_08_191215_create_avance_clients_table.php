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
        Schema::create('avance_clients', function (Blueprint $table) {
            $table->id();
            $table->string('estFinalisee')->default(0);
            $table->boolean('estTotalementRegle')->default(0);
            $table->unsignedBigInteger('ligne_vente_id')->nullable();
            $table->timestamps();
        });
    }

    // #estFinalisee montre si le produit a ete rendu au client (qui avait fait l'avance) ou pas
    // #estTotalementRegle montre si le client a totalement regle le montant ou non. le client peut avoir regle tout mais n'a pas encore recupere son produit

    /**
    * Reverse the migrations.
    */

    public function down(): void
    {
        Schema::dropIfExists('avance_clients');
    }
};