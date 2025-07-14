<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DemandeConge extends Model
{
     protected $fillable = [

        'user_id',
        'type_conge_id',
        'date_debut',
        'date_fin',
        'motif',
        'duree',
        'statut'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(TypeConge::class);
    }
}
