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
        Schema::create('dette_financieres', function (Blueprint $table) {
            $table->id();
            $table->string('type_creancier')->nullable();
            $table->string('nom_creancier')->nullable();
            $table->string('mail_creancier')->nullable();
            $table->string('phone_creancier')->nullable();
            $table->string('adresse_creancier')->nullable();
            $table->string('objet')->nullable();
            $table->date('date_echeance');
            $table->date('date_effet');
            $table->double('montant_emprunte')->default(0.0);
            $table->double('taux_interet')->default(0.0);
            $table->double('montant_interet')->default(0.0);
            $table->double('montant_paye')->default(0.0);
            $table->string('status')->default('En cours');//Règlé
            $table->double('taux_de_penalite')->nullable();
            $table->string('manierePayement')->nullable();
            $table->string('periodicite_de_penalite')->nullable();
            $table->foreignId('system_client_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('banque_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::table('payements', function (Blueprint $table) {
            $table->foreign('dette_financiere_id')->references('id')->on('dette_financieres')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dette_financieres');
    }
};
