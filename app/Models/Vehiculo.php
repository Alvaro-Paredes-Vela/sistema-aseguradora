<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Staudenmeir\LaravelBelongsToThrough\BelongsToThrough;

class Vehiculo extends Model
{
    use HasRelationships;

    protected $table = 'vehiculos';
    protected $primaryKey = 'id_vehiculo'; // Asegúrate de tenerlo

    protected $fillable = [
        'placa',
        'id_cliente',
        'id_modelo',
        'anio_fabricacion',
        'color',
        'nro_chasis',
        'nro_motor',
        'cilindrada',
        'RUAT',
        'tipo_vehiculo',
        'uso_vehiculo',
        'region',
        'tipo_combustible',
        'kilometraje',
        'valor_comercial',
        'estado'
    ];

    protected $casts = [
        'anio_fabricacion' => 'integer',
        'kilometraje' => 'integer',
        'valor_comercial' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
    public function modelo()
    {
        return $this->belongsTo(Modelo::class, 'id_modelo', 'id_modelo');
    }
    public function getMarcaAttribute()
    {
        return $this->modelo?->marca;
    }

    public function cotizaciones()
    {
        return $this->hasMany(Cotizacion::class, 'id_vehiculo', 'id_vehiculo');
    }
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_vehiculo', 'id_vehiculo');
    }
    public function polizas()
    {
        return $this->hasMany(Poliza::class, 'id_vehiculo', 'id_vehiculo');
    }
}
