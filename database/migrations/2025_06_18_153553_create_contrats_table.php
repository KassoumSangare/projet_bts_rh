<?php

use App\Models\Contrat;
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
        Schema::create('contrats', function (Blueprint $table) {
            $table->id();
            $table->enum('type_contrat', [
                'CDI',
                'CDD',
                'CONTRAT_APPRENTISSAGE',
                'CONTRAT_STAGE',
                'CONTRAT_MISSION',
                'CONTRAT_JOURNALIER',
                'CONTRAT_INDEPENDANT'
            ]);
            $table->timestamps();
        });

         Schema::table('employes', function(Blueprint $table){

            $table->foreignIdFor(Contrat::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contrats');
         Schema::table('employes' , function(Blueprint $table){
            $table->dropForeignIdFor(Contrat::class);
        });
    }
};
