<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Departement extends Model
{
    protected $fillable = [
        'nom',
        'description',
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

    //clé étrangère

    public function employe()
    {

        return $this->hasMany(Employe::class);
    }
}
