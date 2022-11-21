<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motos', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('numero_serie')->unique();
            $table->unsignedBigInteger('stock_id');
            $table->string('marque');
            $table->string('modele');
            $table->enum('statut', ['en_stock', 'vendue'])->default('en_stock');
            $table->string('couleur');
            $table->boolean('is_certificat')->default(false);
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
        Schema::dropIfExists('motos');
    }
}
