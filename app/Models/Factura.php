<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $primaryKey = 'nro_factura';

    public $incrementing = false;  // PK no autoincremental
    protected $fillable = [
        'nro_factura',
        'fecha_emision',
        'monto',
        'monto_iva',
        'descripcion',
        'estado',
        'id_pago',
        'razon_social',
        'codigo_control',
        'fecha_limite_emision',
        'son_letras'
    ];

    public function pago()
    {
        return $this->belongsTo(Pago::class, 'id_pago', 'id_pago');
    }
}
