<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    use HasFactory;

    protected $table = 'reclamos';
    protected $primaryKey = 'id_reclamo';


    protected $fillable = [
        'nombre',
        'email',
        'mensaje',
        'fecha_reclamo',
        'estado',
        'id_cliente',
        'id_empleado',
    ];

    // Opcional: castear el enum para mejor manejo
    protected $casts = [
        'fecha_reclamo' => 'date',
        'estado' => 'string',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
}
