<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Presence extends Model
{

    protected $fillable = [
        'user_id',
        'date_de_connexion',
        'date_de_deconnexion',
    ];



    protected $casts = [
        'date_de_connexion' => 'datetime',
        'date_de_deconnexion' => 'datetime',
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

     public function user()
    {
        return $this->belongsTo(User::class);
    }
}
