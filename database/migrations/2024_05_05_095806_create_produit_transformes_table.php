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
        Schema::create('produit_transformes', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('designation');
            $table->string('portion_unitaire');
            // $table->integer('nombre_portions_prevues');
            $table->double('prix_unitaire_portion');
            $table->double('qte_en_portions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produit_transformes');
    }
};
