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
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('matricule')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->date('date_de_naissance')->nullable();
            $table->date('date_recrutement')->nullable();
            $table->string('lieu_de_naissance')->nullable();
            $table->string('situation_matrimoniale');
            $table->integer('nombre_enfants');
            $table->string('titre_poste');
            $table->string('num_cnps');
            $table->string('secteurIntervention');
            $table->string('Nationalite');
            $table->string('tel', 21)->unique();
            $table->string('photo')->nullable();
            $table->foreignId('system_client_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    
    public function down(): void
    {
        Schema::table('personnels', function (Blueprint $table) {
            $table->dropForeign('system_client_id');
        });
        Schema::dropIfExists('personnels');
    }
};
