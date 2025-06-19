<?php

use App\Models\Departement;
use App\Models\Poste;
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
        Schema::create('postes', function (Blueprint $table) {
            $table->id();
            $table->string('titre')->nullable();
            $table->enum('statut', ['actif', 'inactif'])->nullable();
            $table->longText('description')->nullable();
            $table->decimal('salaire_base', 10, 2)->default(0);
            $table->timestamps();
        });



        Schema::table('employes', function (Blueprint $table) {

            $table->foreignIdFor(Poste::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postes');
        Schema::table('employes', function (Blueprint $table) {
            $table->dropForeignIdFor(Poste::class);
        });
    }
};
