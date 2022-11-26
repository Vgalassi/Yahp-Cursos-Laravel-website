<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'descrisimp',
        'descricomp',
        'minalu',
        'maxalu',
        'imagem',
        'status',
        'user_id',
        ];


    public function users(){
        return $this->belongsTomany('App\Models\User');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

}
