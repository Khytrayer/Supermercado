<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Ingrediente;
use App\Models\Distribuidor;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //
        $filters = $request->all('searchName');
        $query = Producto::with('distribuidor');
        if ($request->has('searchName')) {
          $query->where('nombre','like','%'.$filters['searchName'].'%');
        }
        $productos = Producto::Paginate(3);
    
     
    return view("productos.index",compact('productos','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
    {
         $distribuidors = Distribuidor::all();

        return view('productos.create',compact('distribuidors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre' => 'required | max:25 |unique:productos',
            'precio' => 'required | max:4', 
            'distribuidor_id' => 'required',         
        ]);
    
        Producto::create($request->all());
     
        return redirect()->route('productos.index')
                        ->with('success','Producto agregado correctament.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
                // Obtenim un objecte Planet a partir del seu id
        $productos = Producto::findOrFail($id);
        // carreguem la vista i li passem el planeta que volem visualitzar
        return view('productos.show',compact('productos'));
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
        $producto = Producto::findOrFail($id);
        return view('productos.edit',compact('producto'));
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
            'precio' => 'required',            
        ]);
    
        // Opcio 1
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        // Opcio 2
        // $planet->name = $request->name;
        // $planet->save();
    
        return redirect()->route('productos.index')
                        ->with('success','Producto actualizado correctamente');
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
        $producto = Producto::findOrFail($id);
        // intentem esborrar-lo, En cas que un superheroi tingui aquest planeta assignat
        // es produiria un error en l'esborrat!!!!
        try {
            $result = $producto->delete();
            
        }
        catch(\Illuminate\Database\QueryException $e) {
             return redirect()->route('productos.index')
                        ->with('error','Error borrando el producto');
        }   
        return redirect()->route('productos.index')
                        ->with('success','Producto borrado correctamente.');    
    }
}
