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
        Schema::create('comptes_bancaires', function (Blueprint $table) {

            $table->id();
            $table->string('numero_iban')->unique();
            $table->string('numero_bic')->unique();
            $table->string('code_banque')->unique();
            $table->string('code_guichet')->unique();
            $table->string('cle_rib')->unique();
            $table->string('domiciliation');
            $table->string('numero_compte')->unique();
            $table->double('solde')->default(0.0);
            $table->string('devise')->default('FCFA');
            $table->string('cle_iban')->unique();
            $table->string('type');
            $table->string('date_creation');
            $table->foreignId('system_client_id')->constrained()->cascadeOnDelete();
            $table->foreignId('banque_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes_bancaires');
    }
};
