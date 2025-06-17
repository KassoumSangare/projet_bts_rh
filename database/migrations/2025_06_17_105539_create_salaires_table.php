<?php

use App\Models\Salaire;
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
        Schema::create('salaires', function (Blueprint $table) {
            $table->id();
            $table->enum('mois', [
                'janvier',
                'février',
                'mars',
                'avril',
                'mai',
                'juin',
                'juillet',
                'août',
                'septembre',
                'octobre',
                'novembre',
                'décembre'
            ]);
            $table->year('annee');
            $table->decimal('montant', 10, 2);
            $table->timestamps();
        });
         Schema::table('employes', function(Blueprint $table){

            $table->foreignIdFor(Salaire::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaires');

        Schema::table('employes' , function(Blueprint $table){
            $table->dropForeignIdFor(Salaire::class);
        });
    }

};
