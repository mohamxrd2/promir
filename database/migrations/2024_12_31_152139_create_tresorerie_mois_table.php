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
        Schema::create('tresorerie_mois', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tresorerie_id')->constrained();  
            $table->string('mois');
            $table->double('apports_en_capital');
            $table->double('apports_en_compte_courant');
            $table->double('emprunts');
            $table->double('ventes_marchandises');
            $table->double('remboursements_du_credit_tva');
            $table->double('marge_encaissements');
            $table->double('immobilsations_coprporelles');
            $table->double('echenaces_emprunts');
            $table->double('achats_marchandises_effectues');
            $table->double('fournitures');
            $table->double('consommables');
            $table->double('services_exterieurs');
            $table->double('impot_etat');
            $table->double('salaires_nets');
            $table->double('charges_sociales');
            $table->double('tva_a_payer');
            $table->double('solde_precedent');
            $table->double('marge_decaissements');
            $table->double('variation_tresorerie');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tresorerie_mois');
    }
};
