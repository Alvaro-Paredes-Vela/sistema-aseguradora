<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    protected $table = 'cotizaciones';
    protected $primaryKey = 'id_cotizacion';

    protected $fillable = [
        'id_seguro',
        'id_vehiculo',
        'precio_total',
        'cuota_inicial',
        'fecha',
        'total_subcuotas',
        'subcuotas',
    ];

    public function seguro()
    {
        return $this->belongsTo(Seguro::class, 'id_seguro', 'id_seguro');
    }
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_cotizacion', 'id_cotizacion');
    }
}
