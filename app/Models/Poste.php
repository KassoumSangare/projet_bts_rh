<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Poste extends Model
{

    protected $fillable = [
        'titre',
        'statut',
        'description',
        'id_departement',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'modules', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    // Laisons
    public function employe()
    {

        return $this->hasMany(Employe::class);
    }
}
