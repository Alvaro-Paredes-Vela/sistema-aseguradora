<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    protected $table = 'requisitos';
    protected $primaryKey = 'id_requisito';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo',
    ];

    public function seguros()
    {
        return $this->belongsToMany(Seguro::class, 'requisitos_seguros', 'id_requisito', 'id_seguro')
            ->withPivot('obligatorio')->withTimestamps();
    }

    public function siniestros()
    {
        return $this->belongsToMany(Siniestro::class, 'requisitos_siniestro', 'id_requisito', 'id_siniestro')
            ->withPivot('obligatorio')->withTimestamps();
    }
}
