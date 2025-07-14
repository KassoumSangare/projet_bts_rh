<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Conge extends Model
{

    protected $fillable = [
        'employe_id',
        'type_conge',
        'statut',
        'date_debut',
        'date_fin',
        'motif',
        'description',
    ];


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'conges', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }
}
