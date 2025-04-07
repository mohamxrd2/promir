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
        Schema::create('modalite_echellonnee_dette_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dette_fournisseur_id')->nullable();
            $table->foreign('dette_fournisseur_id', 'medf_df_id_foreign')
                ->references('id')
                ->on('dette_fournisseurs')
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
        Schema::dropIfExists('modalite_echellonnee_dette_fournisseurs');
    }
};
