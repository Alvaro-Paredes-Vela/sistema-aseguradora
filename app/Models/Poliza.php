<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $table = 'polizas';
    protected $primaryKey = 'id_poliza';

    protected $fillable = [
        'numero_poliza',
        'fecha_emision',
        'fecha_vencimiento',
        'estado',
        'id_vehiculo',
        'id_seguro',
        'id_venta'
    ];

    protected $casts = [
        'fecha_emision' => 'date',
        'fecha_vencimiento' => 'date', // CLAVE
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
    public function seguro()
    {
        return $this->belongsTo(Seguro::class, 'id_seguro', 'id_seguro');
    }
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id_venta');
    }

    public function primas()
    {
        return $this->hasMany(Prima::class, 'id_poliza', 'id_poliza');
    }
    public function siniestros()
    {
        return $this->hasMany(Siniestro::class, 'id_poliza', 'id_poliza');
    }
}
