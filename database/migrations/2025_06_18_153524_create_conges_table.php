<?php

use App\Models\Conge;
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
        Schema::create('conges', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers la table employes
            $table->unsignedBigInteger('employe_id')->nullable();
            $table->foreign('employe_id')->references('id')->on('employes')->onDelete('cascade');

            $table->enum('type_conge', [
                'conge_annuel',
                'conge_paternite',
                'conge_maladie',
                'conge_exceptionnel',
                'conge_sans_solde',
                'conge_formation',
                'conge_sabbatique',
                'conge_compensateur',
                'autre'
            ]);
            $table->string('statut');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('motif');
            $table->longText('description');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
    }
};
