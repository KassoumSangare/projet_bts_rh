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
            $table->date('date_debut');
            $table->date('date_fin');
            $table->string('motif');
            $table->enum('statut', ['en_attente', 'accepte', 'refuse'])->default('en_attente');
            $table->timestamps();
        });
         Schema::table('employes', function(Blueprint $table){

            $table->foreignIdFor(Conge::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conges');
         Schema::table('employes' , function(Blueprint $table){
            $table->dropForeignIdFor(Conge::class);
        });
    }
};
