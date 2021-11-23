<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conserver extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_reference_materielle_SORTIES',
        'duree_CONSERVER',
    ];
}
