<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Franquicia extends Model
{
    protected $table = 'franquicias';
    protected $primaryKey = 'id_franquicia';

    protected $fillable = [
        'nombre',
        'porcentaje_cobertura',
        'monto_min',
        'monto_max',
        'descripcion',
        'id_siniestro'
    ];

    public function siniestro()
    {
        return $this->belongsTo(Siniestro::class, 'id_siniestro', 'id_siniestro');
    }
}
