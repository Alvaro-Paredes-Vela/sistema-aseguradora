<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';

    protected $fillable = [
        'fecha',
        'monto',
        'comprobante',
        'estado_pago',
        'referencia',
        'id_venta',
        'id_prima',        // ← AGREGA ESTO
        'confirmado_por',
        'motivo_rechazo'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }
    public function prima()
    {
        return $this->belongsTo(Prima::class, 'id_prima', 'id_prima');
    }
    public function facturas()
    {
        return $this->hasMany(Factura::class, 'id_pago', 'id_pago');
    }

    // RELACIÓN NUEVA: QUIÉN APROBÓ EL PAGO
    public function confirmadoPor()
    {
        return $this->belongsTo(Empleado::class, 'confirmado_por', 'id_empleado');
    }
}
