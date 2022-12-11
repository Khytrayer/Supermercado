<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingrediente;

class IngredientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $ingredientes = [
        	['nombre'=>'Sal'],
        	['nombre'=>'Azucar'],
        	['nombre'=>'Pimienta'],
        	['nombre'=>'Hierbabuena'],
        	['nombre'=>'Cilantro'],
        	['nombre'=>'Comino'],

        ];

        Ingrediente::insert($ingredientes);
    }
}