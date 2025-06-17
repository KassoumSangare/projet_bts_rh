<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Presence extends Model
{
    protected $fillable = [
        'date',
        'heure_arrivee',
        'heure_depart',
        'heure_sup',
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

        return $this->belongsTo(Employe::class);
    }
}
