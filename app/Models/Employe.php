<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Employe extends Model
{
    protected $fillable = [
        'nom',
        'prenoms',
        'nationalite',
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
        'departement_id',
        'poste_id',
        'salaire_id',
        'contrat_id',
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



    public function poste()
    {

        return $this->belongsTo(Poste::class);
    }


    public function salaire()
    {

        return $this->belongsTo(Salaire::class);
    }

    public function contrat()
    {
        return $this->belongsTo(Contrat::class);
    }
}
