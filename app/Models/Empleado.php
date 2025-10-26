<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Empleado extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'empleados';
    protected $primaryKey = 'id_empleado';

    protected $fillable = [
        'login',
        'clave',
        'correo',
        'rol',
        'contratacion',
        'estado',
        'nombres',
        'paterno',
        'materno',
        'nro_telefono'
    ];

    protected $casts = [
        'estado' => 'boolean',
        'contratacion' => 'date',
    ];

    protected $hidden = [
        'clave',
        'remember_token',
    ];

    // Especificar que el campo 'login' es el identificador para autenticación
    public function getAuthIdentifierName()
    {
        return 'login';
    }

    // Especificar que el campo 'clave' es la contraseña
    public function getAuthPassword()
    {
        return $this->clave;
    }

    // Hashear la contraseña al guardarla
    public function setClaveAttribute($value)
    {
        if ($value) { // Solo hashear si se proporciona un valor
            $this->attributes['clave'] = bcrypt($value);
        }
    }
}
