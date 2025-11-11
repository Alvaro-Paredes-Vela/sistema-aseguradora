<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Modelo extends Model
{
    use HasRelationships;
    protected $table = 'modelos';
    protected $primaryKey = 'id_modelo';

    protected $fillable = [
        'id_marca',
        'nombre',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class, 'id_modelo', 'id_modelo');
    }
}
