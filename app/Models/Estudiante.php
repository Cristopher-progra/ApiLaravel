<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Estudiante extends Model
{
use HasFactory;
// Nombre de la tabla
protected $table = 'estudiante';
// Campos de la tabla
protected $fillable = [
'nombre',
'edad',
'correo',
'telefono'
];
}

