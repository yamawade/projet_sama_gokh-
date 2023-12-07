<?php

namespace App\Models;

use App\Models\User;
use App\Models\Projet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
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
