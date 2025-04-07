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
        Schema::create('dette_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->double('montant_paye')->default(0.0);
            $table->date('date_effet')->nullable();
            $table->date('date_echeance')->nullable();
            $table->string('status')->default('En cours');//Règlé
            $table->double('taux_de_penalite')->nullable();
            $table->string('periodicite_de_penalite')->nullable();
            $table->string('manierePayement')->nullable();
            $table->timestamps();
        });

        Schema::table('payements', function (Blueprint $table) {
            $table->foreign('dette_fournisseur_id')->references('id')->on('dette_fournisseurs')->onDelete('cascade');
        });
        
    }

    /** 
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dette_fournisseurs');
    }
};
