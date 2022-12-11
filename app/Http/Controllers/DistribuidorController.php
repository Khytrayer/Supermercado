<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distribuidor;

class DistribuidorController extends Controller
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
        $distribuidors = Distribuidor::Paginate(3);
    
        // Carreguem la vista planets/index.blade.php 
        // i li passem la llista de planetes
        return view('distribuidors.index',compact('distribuidors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
        //
        return view("distribuidors.create");
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
        Distribuidor::create($request->all());
     
        return redirect()->route('distribuidors.index')
                        ->with('success','Distribuidor creado correctamente.');
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
        $distribuidor = Distribuidor::findOrFail($id);
        // carreguem la vista i li passem el planeta que volem visualitzar
        return view('distribuidors.show',compact('distribuidor'));
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
        $distribuidor = Distribuidor::findOrFail($id);
        return view('distribuidors.edit',compact('distribuidor'));
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
        $distribuidor = Distribuidor::findOrFail($id);
        $distribuidor->update($request->all());

        // Opcio 2
        // $planet->name = $request->name;
        // $planet->save();
    
        return redirect()->route('distribuidors.index')
                        ->with('success','Distribuidor actualizado correctamente');
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
        $distribuidor = Distribuidor::findOrFail($id);
        // intentem esborrar-lo, En cas que un superheroi tingui aquest planeta assignat
        // es produiria un error en l'esborrat!!!!
        try {
            $result = $distribuidor->delete();
            
        }
        catch(\Illuminate\Database\QueryException $e) {
             return redirect()->route('distribuidors.index')
                        ->with('error','Error al borrar el distribuidor');
        }   
        return redirect()->route('distribuidors.index')
                        ->with('success','Distribuidor borrado correctamente.');    
    }
}
