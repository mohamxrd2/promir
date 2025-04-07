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
        Schema::create('payements', function (Blueprint $table) {
            $table->id();
            $table->double('montant');
            $table->string('reference')->nullable();
            $table->string('fichier_joint')->nullable();
            $table->string('moyen_payement')->nullable();
            $table->unsignedBigInteger('dette_fournisseur_id')->nullable();
            $table->unsignedBigInteger('dettes_client_id')->nullable();
            $table->unsignedBigInteger('dette_financiere_id')->nullable();
            $table->unsignedBigInteger('prestation_service_id')->nullable();
            $table->integer('numero_compte')->nullable();
            $table->unsignedBigInteger('approvisionnement_id')->nullable();
            $table->foreignId('avance_client_id')->nullable()->constrained();
            $table->foreignId('investissement_id')->nullable()->constrained();
            $table->timestamps();
        });
    }












    public function down(): void
    {
        Schema::dropIfExists('payements');
    }
};
