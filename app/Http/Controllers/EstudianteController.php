<?php

namespace App\Http\Controllers;
use App\Models\Estudiante;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    //
    public function updateStudent(Request $request, $id){
        // Se validan los datos a recibir en el request/petición
        $validacion = Validator::make($request->all(),[
        'nombre' => 'required',
        'edad' => 'required',
        'correo' => 'required',
        'telefono' => 'required'
        ]);
        if($validacion->fails()){
        // Si hay error se retorna el mensaje de error
        return response()->json([
        'code' => 400,
        'data' => $validacion->messages()
        ], 400);
        } else {
        // Si no hay error se buscar el estudiante
        $estudiante = Estudiante::find($id);
        if($estudiante){
        // Si el estudiante existe se actualiza
        $estudiante->update([
        'nombre' => $request->nombre,
        'edad' => $request->edad,
        'correo' => $request->correo,
        'telefono' => $request->telefono
        ]);
        // Y se retorna una respuesta en formato json
        return response()->json([
        'code' => 200,
        'data' => 'Estudiante actualizado'
        ], 200);
        } else {
        // Si no existe se retorna una respuesta en formato json
        return response()->json([
        'code' => 404,
        'data'=> 'Estudiante no encontrado'
        ], 404);
        }
        }
        }
        public function findStudent($id){
            // Se busca el estudiante
            $estudiante = Estudiante::find($id);
            if($estudiante){
            // Si existe se retorna la información en formato json
            return response()->json([
            'code' => 200,
            'data'=> $estudiante
            ], 200);
            } else {
            // Si no existe se retorna un mensaje en formato json
            return response()->json([
            'code' => 404,
            'data'=> 'Estudiante no encontrado'
            ], 404);
            }
            }
            public function deleteStudent($id){
                // Se busca el estudiante
                $estudiante = Estudiante::find($id);
                if($estudiante){
                // Si el estudiante existe se elimina
                $estudiante->delete();
                // Y se retorna una respuesta en formato json
                return response()->json([
                'code' => 200,
                'data'=> 'Estudiante eliminado'
                ], 200);
                } else {
                // Si no existe se retorna una respuesta en formato json
                return response()->json([
                'code' => 404,
                'data'=> 'No hay registros'
                ], 404);
                }
                }
                
        
}

