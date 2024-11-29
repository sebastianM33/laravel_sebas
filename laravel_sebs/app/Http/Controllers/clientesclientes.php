<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class clientesclientes extends Controller
{
    public function lista()

        {
            $clientes = Cliente::all();
            if ($clientes->isEmpty()){
                $data = [
                    'mensaje' => 'No se encontraron clientes',
                    'estado' => 200
                ];
                return response() ->json($data,204);
            };
            return response() -> json($clientes,200);
        }

        public function cliente($id)
        {
            // Buscar el cliente por ID
            $cliente = Cliente::find($id);

        }
    public function crear(Request $request) 

        {
                // Crear las reglas de validación
                $validador = Validator::make($request->all(), [
                    'nombre' => 'required|max:255', 
                    'correo' => 'required|email', 
                    'telefono' => 'required'
                ]);

                if ($validador->fails()){
                    $data = [
                        'mensaje' => 'Error en la validación de datos',
                        'errores' => $validador ->errors(),
                        'estado' => 400
                    ];
                    return response() ->json($data,400);
                }
    
    
                $cliente = Cliente::create([
                    'nombre' => $request->nombre,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono
                ]);
    
    
                if (!$cliente){
                    $data = [
                        'mensaje' => 'Error al crear el cliente',
                        'estado' => 500
                    ];
                    return response() -> json($data,500);
                }
                $data = [
                    'Cliente' => $cliente,
                    'estado' => 201
                ];
    
                
    
        }
        public function actualizar(Request $request,$id)
        {
            $cliente = Cliente::find($id);
           
            if (!$cliente){
                $data = [
                    'mensaje' => 'Error no se encontro el  cliente',
                    'estado' => 404
                ];
                return response() -> json($data,404);
            }


            $validador = Validator::make($request->all(),[
                'nombre' => 'required|max:255', 
                'correo' => 'required|email', 
                'telefono' => 'required'
     ]);
       
            if ($validador->fails()){
                $data = [
                    'mensaje' => 'Error los datos no cumplen con la validacion',
                    'estado' => 400
                ];
                return response() ->json($data,400);
            }


            $cliente -> nombre = $request->nombre;
            $cliente -> correo = $request->correo;
            $cliente -> telefono = $request->telefono;


            $cliente -> save();


            $data = [
                'Mensaje' => 'Cliente Actualizado',
                'Cliente' => $cliente,
                'Estado' => 200
            ];


            return response() -> json($data,200);


        }


        
    public function eliminar($id)

        {
            $cliente = Cliente::find($id);
            if ($cliente){
                $cliente -> delete();

            }
                $data = [
                    'mensaje' => 'cliente eliminado',
                    'estado' => 200
                ];


                return response() -> json($data,200);

        }
     

 
        
    public function actualización_parcial(Request $request, Cliente $cliente) {
            // Validación de los datos, los campos son opcionales (nullable) 
            $request->validate([ 
            'nombre' => 'nullable|string|max:255', // El nombre es opcional 
            'correo' => 'nullable|email|unique:clientes,correo,' . $cliente->id, // El correo es opcional y único 
            'telefono' => 'nullable|string|max:20', // El teléfono es opcional
        ]);
        if ($request->has('nombre')) { 
            $cliente->nombre = $request->nombre;
        }
        if ($request->has('correo')) { 
            $cliente->correo = $request->correo;
        }
        if ($request->has('telefono')) { 
            $cliente->telefono = $request->telefono;
        }


        $cliente->save();
        $data = [ 
            'Mensaje' => 'Cliente Actualizado', 
            'Cliente' => $cliente, 
            'Estado' => 200,
        ];
        return response()->json($data, 200);
    }

}
