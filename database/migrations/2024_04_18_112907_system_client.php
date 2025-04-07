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
        Schema::create("system_clients", function (Blueprint $table) {
            $table->id();
            $table->string('deno_sociale');
            $table->string('sigle')->nullable();
            $table->string('type');
            $table->string('devise', 3)->default('XOF');
            $table->date('date_creation');
            $table->string('pays');
            $table->string('region');
            $table->string('localite');
            $table->string('adresse_geographique')->nullable();
            $table->string('tel')->nullable();
            $table->string('cel')->nullable();
            $table->string('mail_entreprise')->nullable();
            $table->string('lien_page_fbook')->nullable();
            $table->string('lien_site_web')->nullable();
            $table->double('capital_social')->default(0);
            $table->integer('nbr_employes')->nullable();
            $table->integer('chiffre_affaire')->nullable();
            $table->string('sect_activite');
            $table->string('regime_fiscal')->nullable();
            $table->string('num_cnps')->nullable();
            $table->string('centre_impot')->nullable();
            $table->string('status_compte');
            $table->string('logo_image')->nullable();
            $table->timestamps();
        });


        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('system_client_id')->nullable()->constrained(
                table: 'system_clients', indexName: 'system_client_id'
            );
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('system_client_id');
        });

        Schema::dropIfExists('system_clients');

    }
};
