<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneratorPet extends Model
{
    protected $fillable = ['name', 'secret'];

    protected $hidden = ['secret'];
}
