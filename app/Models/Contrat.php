<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Contrat extends Model
{
    protected $fillable = [
        'type_contrat',
        'date_debut',
        'date_fin',
        'statut',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'modules', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    // Liaison
    public function employe()
    {

        return $this->hasMany(Employe::class);
    }
}
