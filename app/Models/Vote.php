<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = [
        'reponse',
        'user_id',
        'projet_id'
    ];
    		
    public function user(){
        return ($this->belongsTo(User::class,'user_id'));
    }

    public function projet(){
        return ($this->belongsTo(Projet::class,'projet_id'));
    }
}
