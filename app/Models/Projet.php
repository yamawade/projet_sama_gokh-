<?php

namespace App\Models;

use App\Models\Mairie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projet extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'description',
        'date_projet',
        'date_limite_vote',
        'image',
        'user_id',
        'mairie_id'
    ];
    						

    public function user(){
        return ($this->belongsTo(User::class,'user_id'));
    }

    public function mairie(){
        return ($this->belongsTo(Mairie::class,'mairie_id'));
    }
}
