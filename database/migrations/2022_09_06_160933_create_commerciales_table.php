<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commerciales', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('nom');
            $table->string('prenom');
            $table->string('numero');
            $table->string('numero2');
            $table->string('identifiant');
            $table->string('numero_ifu');
            $table->string('pseudo');
            $table->string('adresse');
            $table->string('logo')->nullable();


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
        Schema::dropIfExists('commerciales');
    }
}
