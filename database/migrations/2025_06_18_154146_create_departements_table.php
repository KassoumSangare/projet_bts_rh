<?php

use App\Models\Departement;
use App\Models\Employe;
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
        Schema::create('departements', function (Blueprint $table) {
            $table->id();
            $table->string('nom')->unique();
            $table->longText('description');
            $table->enum('statut', ['EN_SERVICE', 'HORS_SERVICE']);
            $table->timestamps();
        });


        Schema::table('employes',function(Blueprint $table){

           $table->foreignIdFor(Departement::class)->constrained()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
        Schema::table('employes', function(Blueprint $table){

            $table->dropForeignIdFor(Departement::class);
        });





    }
};
