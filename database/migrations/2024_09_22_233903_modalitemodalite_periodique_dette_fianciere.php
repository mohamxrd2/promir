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
        Schema::create('modalite_periodique_dette_fiancieres', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dette_financiere_id')->nullable();
            $table->foreign('dette_financiere_id', 'mpdfi_dfi_id_foreign')
                ->references('id')
                ->on('dette_financieres')
                ->cascadeOnDelete();
            $table->double('montant');
            $table->string('status')->default('En cours');//Règlé
            $table->integer('nombre_depayement')->default(0);
            $table->string('periodicite_payement')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modalite_periodique_dette_fiancieres');
    }
};
