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
        Schema::create('jour_de_repo_system_clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_client_id')->constrained();
            $table->foreignId('jour_de_repo_id')->constrained();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jour_de_repo_system_clients', function (Blueprint $table) {
            $table->dropForeign(['system_client_id']);
            $table->dropForeign(['jour_de_repo_id']);
        });

        Schema::dropIfExists('jour_de_repo_system_clients');
    }
};
