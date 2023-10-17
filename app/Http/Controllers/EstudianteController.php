<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function selectStudent()
    {
        $estudiantes = Estudiante::all();
        if ($estudiantes->count() > 0) {
            return response()->json([
                'code' => 200,
                'data' => $estudiantes
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data' => 'No hay registros'
            ], 404);
        }
    }

    public function storeStudent(Request $request)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'edad' => 'required',
            'correo' => 'required',
            'telefono' => 'required',
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $estudiante = Estudiante::create($request->all());
            return response()->json([
                'code' => 200,
                'data' => 'Estudiante insertado'
            ], 200);
        }
    }

    public function updateStudent(Request $request, $id)
    {
        $validacion = Validator::make($request->all(), [
            'nombre' => 'required',
            'edad' => 'required',
            'correo' => 'required',
            'telefono' => 'required'
        ]);

        if ($validacion->fails()) {
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            $estudiante = Estudiante::find($id);

            if ($estudiante) {
                $estudiante->update([
                    'nombre' => $request->nombre,
                    'edad' => $request->edad,
                    'correo' => $request->correo,
                    'telefono' => $request->telefono
                ]);

                return response()->json([
                    'code' => 200,
                    'data' => 'Estudiante actualizado'
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'Estudiante no encontrado'
                ], 404);
            }
        }
    }

    public function findStudent($id)
    {
        $estudiante = Estudiante::find($id);

        if ($estudiante) {
            return response()->json([
                'code' => 200,
                'data' => $estudiante
            ], 200);
        } else {
            return response()->json([
                'code' => 404,
                'data' => 'Estudiante no encontrado'
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


