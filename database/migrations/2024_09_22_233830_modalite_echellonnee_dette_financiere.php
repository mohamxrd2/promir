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
        Schema::create('modalite_echellonnee_dette_financieres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dette_financiere_id')->nullable();
            $table->foreign('dette_financiere_id', 'medfi_dfi_id_foreign')
                ->references('id')
                ->on('dette_financieres')
                ->cascadeOnDelete();
            $table->double('montant');
            $table->string('status')->default('En attente');//Règlé
            $table->date('date_reglement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modalite_echellonnee_dette_financieres');
    }
};
