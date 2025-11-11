<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialPrecio extends Model
{
    protected $table = 'historial_precios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_seguro',
        'fecha',
        'precio',
    ];

    public function seguro()
    {
        return $this->belongsTo(Seguro::class, 'id_seguro', 'id_seguro');
    }
}
