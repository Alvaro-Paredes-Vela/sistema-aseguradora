<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Marca extends Model
{
    use HasRelationships;
    protected $table = 'marcas';
    protected $primaryKey = 'id_marca';

    protected $fillable = [
        'nombre',
    ];

    public function modelos()
    {
        return $this->hasMany(Modelo::class, 'id_marca', 'id_marca');
    }
}
