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
        Schema::create('prestation_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ligne_client_systeme_id')->nullable()->constrained()->cascadeOnDelete();
            $table->double('montant_facture')->default(0.0);
            $table->timestamps();
        });

        Schema::table('payements', function (Blueprint $table) {
            $table->foreign('prestation_service_id')->references('id')->on('prestation_services')->onDelete('cascade');
        });

        Schema::table('dettes_clients', function (Blueprint $table) {
            $table->foreign('prestation_service_id')->references('id')->on('prestation_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestation_services');
    }
};
