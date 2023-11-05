<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Endpoint para registrar nuevos usuarios
    public function store(Request $request){
        // Validar campos
        $validacion = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
    
        if ($validacion->fails()) {
            // Si la validación falla, se retornan los mensajes de error
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            // Si la validación no falla, se crea el usuario
            $usuario = User::create($request->all());
    
            // Se devuelven los datos del usuario junto a un token
            return response()->json([
                'code' => 200,
                'data' => $usuario,
                'token' => $usuario->createToken('token')->plainTextToken
            ], 200);
        }
    }
    public function login(Request $request){
        // Validar campos
        $validacion = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
    
        if ($validacion->fails()) {
            // Si la validación falla, se retornan los mensajes de error
            return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
            ], 400);
        } else {
            // Si la validación no falla, se verifica que el usuario exista y la contraseña sea la correcta
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                // Si son credenciales válidas, se devuelven los datos del usuario junto a un token
                $usuario = User::where('email', $request->email)->first();
                return response()->json([
                    'code' => 200,
                    'data' => $usuario,
                    'token' => $usuario->createToken('token')->plainTextToken
                ], 200);
            } else {
                // Si son credenciales inválidas, se devuelve un mensaje denegando el acceso
                return response()->json([
                    'code' => 401,
                    'data' => 'Usuario no autorizado'
                ], 401);
            }
        }
    }
    
}
