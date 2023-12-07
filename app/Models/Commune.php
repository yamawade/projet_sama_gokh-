<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'statut',
        'is_disponible',
        'region_id'
    ];
    		
    public function region(){
        return ($this->belongsTo(Region::class,'region_id'));
    }
}
