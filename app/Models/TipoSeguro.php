<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoSeguro extends Model
{
    protected $table = 'tipos_seguro';
    protected $primaryKey = 'id_tipo_seguro';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function seguros()
    {
        return $this->hasMany(Seguro::class, 'id_tipo_seguro', 'id_tipo_seguro');
    }
}
