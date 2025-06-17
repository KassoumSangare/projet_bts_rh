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
            $table->string('nom');
            $table->string('prenom');
            $table->string('nationalite',20);
            $table->string('contact_urgence',20);
            $table->string('numero_compte_bancaire');
            $table->string('matricule')->unique();
            $table->string('sexe',10);
            $table->date('date_naissance');
            $table->string('email', 255)->unique();
            $table->text('telephone',20);
            $table->text('adresse',255);
            $table->date('date_embauche');
            $table->enum('statut', ['actif', 'inactif', 'suspendu'])->default('actif');
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
