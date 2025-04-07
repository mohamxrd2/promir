<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paie_salariers', function (Blueprint $table) {
            $table->id();
            $table->double('salaire_base')->nullable();
            $table->double('autres_avantages');
            $table->string('periode_paie');
            $table->integer('nombre_de_parts');
            $table->double('prime_transport');
            $table->integer('anciennete');
            $table->double(column: 'cmu');
            $table->double('sursalaire');
            $table->double('salaireBrutImposable');
            $table->double('retenu_ITS');
            $table->string('situation_matrimoniale');
            $table->integer('nombre_enfants');
            $table->foreignId('personnel_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paie_salariers');
    }
};
