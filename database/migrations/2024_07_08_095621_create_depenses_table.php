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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_client_id')->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('type_depense_id');
            $table->string('libelle');
            $table->string('montant');
            $table->string('montant_regle');
            $table->string('montant_regle_sur_place');
            $table->string('moyen_payement');
            $table->string('reference_payement');
            $table->string('beneficiaire');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
