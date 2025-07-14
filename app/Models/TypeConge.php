<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeConge extends Model
{
   protected $fillable = [
    'type',
    'libelle',
    'duree'
   ];
   public function demandes()
    {
        return $this->hasMany(DemandeConge::class);
    }
}
