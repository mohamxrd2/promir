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
        Schema::create('caisses', function (Blueprint $table) {
            $table->id();
            $table->double('solde')->default(0.0);
            $table->string('nom')->default('Caisse principale');
            $table->foreignId('system_client_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }
   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caisses');
    }
};
