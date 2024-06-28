<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelnetPersonnel extends Model
{
    use HasFactory;
    protected $fillable=([
        'category_id',
        'position_id',
        'login',
        'password',
        'name',
        'status'
    ]);

    public function category()
    {
        return $this->belongsTo(TelnetCategory::class,'category_id');
    }

    public function position()
    {
        return $this->belongsTo(TelnetPosition::class,'position_id');
    }

}
