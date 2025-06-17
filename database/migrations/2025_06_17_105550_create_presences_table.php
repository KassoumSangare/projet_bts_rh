<?php

use App\Models\Presence;
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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('heure_arrivee');
            $table->time('heure_depart');
            $table->time('heure_sup')->nullable();
            $table->timestamps();
        });
         Schema::table('employes', function(Blueprint $table){

            $table->foreignIdFor(Presence::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
         Schema::table('employes' , function(Blueprint $table){
            $table->dropForeignIdFor(Presence::class);
        });
    }
};
