<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Employe extends Model
{
    protected $fillable = [

        'nom',
        'prenom',
        'Nationalite',
        'contact_urgence',
        'numero_compte_bancaire',
        'matricule',
        'sexe',
        'date_naissance',
        'email',
        'telephone',
        'adresse',
        'date_embauche',
        'statut',
        'id_poste',
        'id_contrat',
        'id_departement',
        'id_presence',
        'id_salaire',
        'id_conge',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'modules', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    // clés étrangères

    public function departement()
    {

        return $this->belongsTo(Departement::class);
    }


    public function conge()
    {

        return $this->hasMany(Conge::class);
    }


    public function poste()
    {

        return $this->belongsTo(Poste::class);
    }


    public function presence()
    {

        return $this->hasMany(Presence::class);
    }

    public function salaire()
    {

        return $this->hasMany(Salaire::class);
    }

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}
