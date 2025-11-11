<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Cliente extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'CI',
        'login',
        'password',
        'correo',
        'nombre',
        'paterno',
        'materno',
        'direccion',
        'telefono',
        'estado',
        'foto'
    ];

    // Especificar el nombre del campo de contraseña
    protected $hidden = ['password']; // Ocultar la contraseña al serializar
    protected $casts = [
        'estado' => 'boolean',
    ];

    // Sobrescribir el método para usar 'clave' en lugar de 'password'
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Opcional: Si usas un campo personalizado para el identificador
    public function getAuthIdentifierName()
    {
        return 'login'; // Usar 'login' como identificador en lugar de 'id'
    }

    public function getAuthIdentifier()
    {
        return $this->id_cliente; // Devolver el id_cliente como identificador
    }

    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_cliente', 'id_cliente');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_cliente', 'id_cliente');
    }
    public function reclamos()
    {
        return $this->hasMany(Reclamo::class, 'id_cliente', 'id_cliente');
    }
}
