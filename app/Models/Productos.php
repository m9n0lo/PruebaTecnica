<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    /** @use HasFactory<\Database\Factories\ProductosFactory> */
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre','precio','categoria_id','descripcion','stock','imagen'
    ];

    protected $appends = ['agotado'];

    public function categorias()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }

    public function getAgotadoAttribute(): bool
    {
        return ($this->stock ?? 0) <= 0;
    }
}
