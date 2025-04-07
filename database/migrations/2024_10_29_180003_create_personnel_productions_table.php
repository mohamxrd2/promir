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
        Schema::create('personnel_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('production_id')->nullable()->constrained()->cascadeOnDelete();
            $table->double(column: 'heures');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('personnel_productions');
    }
};
