<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Mail;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
           
        // try {
        //     $rules = [
        //         'nombre'=>'required|min:2',
        //         'apellido'=>'required|min:2|max:4',
        //         'email' => 'email:rfc,dns'
        //     ];
        //     $this->validate($request,$rules);
    

        //     $product =new Product();
        //     $product->nombre =$request->nombre;
        //     $product->apellido =$request->apellido;
        //     $product->email =$request->email;
        //     $product->save();
        //     ///return  $product;
        //     return response()->json([
        //         'mensaje' => 'Se Agrego Correctamente el Registro de Productos',
        //         'data' => $product,
        //     ]);
            
        // } catch (\Exception $e) {
            
        //     return response()->json([
        //         'mensaje' => 'Error Al Recibir los Datos',
                
        //     ]);
        // }
    
        try {
            $rules = [
                'nombre'=>'required|min:2',
                'apellido'=>'required|min:2|max:20',
                'email' => 'email:rfc,dns'
            ];

            $message  = [
                'nombre.required'=>'El Nombre No Puede ser NULL',
                'nombre.min'=>'el nombre debe tener mas de dos dig'
            
            ];

            $this->validate($request,$rules,$message);
    
            
            $product =new Product();
            $product->nombre =$request->nombre;
            $product->apellido =$request->apellido;
            $product->email =$request->email;
            
   
            
            $product->save();

            $details = [
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido
                    ];
                
             Mail::to('ceciliaceb@gmail.com')->send(new \App\Mail\RegistroMail($details));

             
            
             return response()->json([
                'mensaje' => 'Registro Correcto',
                'data' => $product->nombre,
            ]);
            
            
        } catch (\Exception $e) {
            
            return response()->json([
                'mensaje' => $message,
                
            ]);
        
        }   

    
           
    }  
       

    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
