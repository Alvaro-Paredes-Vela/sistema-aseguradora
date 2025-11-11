<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
        'coberturas',
        'descripcion'
    ];

    public function seguros()
    {
        return $this->hasMany(Seguro::class, 'id_categoria', 'id_categoria');
    }
}
