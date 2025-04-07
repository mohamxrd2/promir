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
        Schema::create('investissements', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('categorie');
            $table->string('libelle');
            $table->double('montant');
            $table->double('montant_paye');
            $table->string('date_acquisition')->nullable();
            $table->double('duree_de_vie')->nullable();
            $table->string('date_peremption')->nullable();
            $table->string('status')->nullable();
            $table->foreignId('system_client_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investissements');
    }
};
