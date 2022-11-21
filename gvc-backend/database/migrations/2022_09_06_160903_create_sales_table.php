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
            $table->string('numero_client');
            $table->string('adresse_client');
            $table->string('identifiant_client');
            $table->unsignedBigInteger('commerciale_id');
            $table->unsignedBigInteger('moto_id')->uniqid();
            $table->string('prix_vente');
            $table->string('montant_verse');
            $table->string('montant_restant')->nullable();
            $table->enum('statut', ['en_cours', 'payé',]);
            $table->date('date_versement')->nullable();
            $table->string('numero_facture')->unique()->nullable();
            $table->boolean('is_certificat')->default(false);
            $table->boolean('with_registration')->default(true);
            $table->boolean('is_registred')->default(false);
           


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
