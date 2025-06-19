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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('contact_urgence')->nullable();
            $table->string('numero_compte_bancaire')->nullable();
            $table->string('matricule')->unique()->nullable();
            $table->enum('sexe',['masculin', 'feminin'])->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('email')->unique()->nullable();
            $table->text('telephone')->nullable();
            $table->text('adresse')->nullable();
            $table->date('date_embauche')->nullable();
            $table->enum('statut', ['actif', 'inactif', 'suspendu'])->default('actif');
            $table->foreignId('departements');
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
