<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ingrediente extends Model
{
    use HasFactory;


    public function producto()
    {
    	return $this->belongsToMany(Producto::class,'productos_ingredientes');
    }
}
