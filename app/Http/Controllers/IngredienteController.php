<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingrediente;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //
                // Recuperem una col·lecció amb tots els planetes de la BD
        $ingredientes = Ingrediente::Paginate(3);
    
        // Carreguem la vista planets/index.blade.php 
        // i li passem la llista de planetes
        return view('ingredientes.index',compact('ingredientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        //
        return view("ingredientes.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validació dels camps
        $request->validate([
            'nombre' => 'required',            
        ]);
    
        // Primera forma: breu,insegura, necessita tenir array $fillable al model
        Ingrediente::create($request->all());
     
        return redirect()->route('ingredientes.index')
                        ->with('success','Ingrediente creado correctamente.');
        // Segona forma: més llarg...més segur..
        
        // $planet = new Planet;
        // $planet->name = $request->name;
        // $planet->save();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtenim un objecte Planet a partir del seu id
        $ingredientes = Ingrediente::findOrFail($id);
        // carreguem la vista i li passem el planeta que volem visualitzar
        return view('ingredientes.show',compact('ingrediente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
    {
        //
        $ingrediente = Ingrediente::findOrFail($id);
        return view('ingredientes.edit',compact('ingrediente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nombre' => 'required',           
        ]);
    
        // Opcio 1
        $ingrediente = Ingrediente::findOrFail($id);
        $ingrediente->update($request->all());

        // Opcio 2
        // $planet->name = $request->name;
        // $planet->save();
    
        return redirect()->route('ingredientes.index')
                        ->with('success','Ingrediente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        //  Obtenim el planeta que volem esborrar
        $ingrediente = Ingrediente::findOrFail($id);
        // intentem esborrar-lo, En cas que un superheroi tingui aquest planeta assignat
        // es produiria un error en l'esborrat!!!!
        try {
            $result = $ingrediente->delete();
            
        }
        catch(\Illuminate\Database\QueryException $e) {
             return redirect()->route('ingredientes.index')
                        ->with('error','Error al borrar el ingrediente');
        }   
        return redirect()->route('ingredientes.index')
                        ->with('success','Ingrediente borrado correctamente.');    
    }
}
