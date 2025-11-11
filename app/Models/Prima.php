<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prima extends Model
{
    protected $table = 'primas';
    protected $primaryKey = 'id_prima';

    protected $fillable = [
        'id_poliza',
        'monto',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'descripcion',
    ];

    public function poliza()
    {
        return $this->belongsTo(Poliza::class, 'id_poliza', 'id_poliza');
    }
    public function pagos()
    {
        return $this->hasMany(Pago::class, 'id_prima', 'id_prima');
    }
}
