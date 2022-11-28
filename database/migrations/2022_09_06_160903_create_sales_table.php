<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('nom_client');
            $table->string('prenom_client');
            $table->string('numero_client');
            $table->string('adresse_client');
            $table->string('identifiant_client');
            $table->unsignedBigInteger('commercial_id');
            $table->unsignedBigInteger('moto_id')->uniqid();
            $table->string('prix_vente');
            $table->string('montant_verse');
            $table->string('montant_restant')->nullable();
            $table->enum('statut_payement', ['en_cours', 'termine'])->default('termine');
            $table->date('date_versement')->nullable();
            $table->string('penalite')->nullable();
            $table->boolean('is_certificat')->default(false);
            $table->string('numero_facture')->unique()->nullable();
            $table->enum('registration_statut', ['pas_enregistre', 'enregistre', 'termine',]);
            $table->boolean('with_registration')->default(true);



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventes');
    }
}
