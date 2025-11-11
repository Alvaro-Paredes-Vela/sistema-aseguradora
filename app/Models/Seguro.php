<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;

    protected $table = 'seguros';
    protected $primaryKey = 'id_seguro';

    protected $fillable = [
        'id_tipo',
        'id_categoria',
        'nombre',
        'vigencia',
        'precio'
    ];

    public function tipoSeguro()
    {
        return $this->belongsTo(TipoSeguro::class, 'id_tipo', 'id_tipo');
    }
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function historialPrecios()
    {
        return $this->hasMany(HistorialPrecio::class, 'id_seguro', 'id_seguro');
    }
    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'id_seguro', 'id_seguro');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_seguro', 'id_seguro');
    }
    public function polizas()
    {
        return $this->hasMany(Poliza::class, 'id_seguro', 'id_seguro');
    }

    public function requisitos()
    {
        return $this->belongsToMany(Requisito::class, 'requisitos_seguros', 'id_seguro', 'id_requisito')
            ->withPivot('obligatorio')->withTimestamps();
    }
}
