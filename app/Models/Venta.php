<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'fecha',
        'id_cliente',
        'id_empleado',
        'id_vehiculo',
        'id_seguro',
        'id_cotizacion',
        'monto_total'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
    public function seguro()
    {
        return $this->belongsTo(Seguro::class, 'id_seguro', 'id_seguro');
    }
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class, 'id_cotizacion', 'id_cotizacion');
    }

    public function polizas()
    {
        return $this->hasMany(Poliza::class, 'id_venta', 'id_venta');
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_venta', 'id_venta');
    }
}
