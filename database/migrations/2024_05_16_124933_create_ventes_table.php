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
        Schema::create('ventes', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('moyen_payement')->default('Cash');
            $table->string('type_vente')->default('Locale');
            $table->string(column: 'status_vente')->default('Confirmée');
            $table->foreignId('ligne_client_systeme_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
        * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists('ventes');
    }
};
