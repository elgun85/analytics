<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelnetPosition extends Model
{
    use HasFactory;
    protected $fillable=([
        'category_id',
        'title',
        'slug',
        'position'
    ]);

    public function category()
    {
        return $this->belongsTo(TelnetCategory::class,'category_id');
    }
}
