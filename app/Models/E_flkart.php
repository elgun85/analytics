<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class E_flkart extends Model
{
    use HasFactory;

    protected $fillable=[

        'NOTEL',
        'KODQURUM'  ,
        'X_KART' ,
        'KODTARIF' ,
        'RENTA'  ,
        'KODLQOT'  ,
        'ABONENT'  ,
        'ABONENT2' ,
        'SAYTEL'   ,
        'SUMMA0'   ,
        'SUMMA'    ,
        'NONARYAD' ,
        'UZEL'     ,
        'DTNARYAD' ,
        'DTNARYAD1',
        'TMNARYAD1',
        'DTNARYAD2',
        'KODXIDMET',
        'KODIST'   ,
        'AD_UCRET_K',
        'AY'       ,
        'IL'       ,
    ];
}
