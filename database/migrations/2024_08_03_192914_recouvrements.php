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
        Schema::create('recouvrements', function (Blueprint $table) {
            $table->id();
            $table->double('somme');
            $table->string('reference')->nullable();
            $table->string('fichier_joint')->nullable();
            $table->foreignId('impaye_vente_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('recouvrements');
    }
};
