<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Salaire extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'date',
        'employe_id',
        'montant',
        'poste_id'

    ];



    public function employe()
    {
        return $this->belongsTo(Employe::class);
    }

    public function poste(){
        return $this->belongsTo(Poste::class);
    }



}
