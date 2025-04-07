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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('nom');
            $table->string('adresse')->nullable();
            $table->string('email')->unique();
            $table->string('phone', 20)->unique();
            $table->string('seconde_phone', 20)->unique();
            $table->string('region');
            $table->string('departement');
            $table->string('localite');
            $table->string('pays');
            $table->timestamps();
        });
    }


   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
