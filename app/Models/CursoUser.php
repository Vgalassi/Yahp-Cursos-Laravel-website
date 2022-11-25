<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CursoUser extends Model
{
    use HasFactory;

    protected $table = 'curso_user';

    protected $fillable = [
        'nota',
    ];
}
