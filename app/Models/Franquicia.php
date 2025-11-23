<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Franquicia extends Model
{
    protected $table = 'franquicias';
    protected $primaryKey = 'id_franquicia';

    protected $fillable = [
        'nombre',
        'monto',
        'porcentaje',
        'descripcion',
        'id_poliza'
    ];

    public function poliza()
    {
        return $this->belongsTo(Poliza::class, 'id_poliza', 'id_poliza');
    }
}
