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
        Schema::create('inventaires', function (Blueprint $table) {
            $table->id();
            $table->morphs('produitable');
            $table->double('quantite_theorique');
            $table->double('prix_unitaire');
            $table->double('quantite_physique');
            $table->double('portions')->nullable();
            $table->double('unites')->nullable();
            $table->date('date_inventaire');
            $table->timestamps();
        });
    }

   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventaires');
    }
};
