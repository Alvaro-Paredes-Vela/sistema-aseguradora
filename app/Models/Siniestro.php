<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siniestro extends Model
{
    use HasFactory;

    protected $table = 'siniestros';
    protected $primaryKey = 'id_siniestro';

    protected $fillable = [
        'fecha',
        'descripcion',
        'ubicacion',
        'hora',
        'monto_estimado',
        'estado',
        'id_poliza',
        'id_empleado'
    ];

    public function poliza()
    {
        return $this->belongsTo(Poliza::class, 'id_poliza', 'id_poliza');
    }
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado', 'id_empleado');
    }

    public function requisitos()
    {
        return $this->belongsToMany(Requisito::class, 'requisitos_siniestro', 'id_siniestro', 'id_requisito')
            ->withPivot('obligatorio')->withTimestamps();
    }

    public function franquicias()
    {
        return $this->hasMany(Franquicia::class, 'id_siniestro', 'id_siniestro');
    }
}
