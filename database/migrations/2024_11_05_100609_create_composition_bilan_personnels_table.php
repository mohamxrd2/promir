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
        Schema::create('composition_bilan_personnels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bilan_personnel_id')->constrained();
            $table->string('type')->nullable();
            $table->string('categorie')->nullable();
            $table->string('libelle')->nullable();
            $table->double('valeur')->nullable();
            $table->timestamps();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('composition_bilan_personnels');
    }
};
