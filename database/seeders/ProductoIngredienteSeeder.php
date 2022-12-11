<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoIngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('productos_ingredientes')->insert ([
        	'producto_id' =>2,
        	'ingrediente_id'=>1]);
        DB::table('productos_ingredientes')->insert ([
        	'producto_id' =>3,
        	'ingrediente_id'=>1]);
        DB::table('productos_ingredientes')->insert ([
        	'producto_id' =>4,
        	'ingrediente_id'=>1
        ]);
    }
}
