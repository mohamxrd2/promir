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

        Schema::create('contrat_personnels', function (Blueprint $table) {
            $table->id();
            $table->string('num_contrat')->unique();
            $table->date('date_debut');
            $table->string('categorie');
            $table->string('type_emploi');
            $table->double('salaire_mensuel')->nullable();
            $table->double('nbr_jour_tr_pj')->nullable();
            $table->double('nbr_h_tr_pj')->nullable();
            $table->time('h_debut_tr');
            $table->double('nbr_h_pause_pj');
            $table->foreignId('personnel_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

         
        Schema::enableForeignKeyConstraints();
    }

    
    public function down(): void
    {
        
        Schema::dropIfExists('contrat_personnels');
    }
};
