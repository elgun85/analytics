<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelnetCategory extends Model
{
    use HasFactory;
    protected $fillable=([
        'title',
        'slug'
    ]);

    public function positions()
    {
        return $this->hasMany(TelnetPosition::class,'category_id');
    }
}
