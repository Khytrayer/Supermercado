<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nombre',
        'precio',
        'distribuidor_id'
    ];

    public function distribuidor() {
    	return $this->belongsTo(Distribuidor::class);
	}

    public function ingrediente() {

    return $this->belongsToMany(Ingrediente::class,
        'productos_ingredientes');
    }
}
