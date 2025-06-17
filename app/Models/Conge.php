<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Conge extends Model
{

    protected $fillable = [
        'type_conge',
        'date_debut',
        'date_fin',
        'statut',
        'motif',
    ];

     public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'modules', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }


    // laisons
    public function employe()
        {

            return $this->belongsTo(Employe::class);
        }
}
