<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    use HasFactory;
    protected $table="etiquetas";

    public function etiquetaProducto() {
        return $this->belongsToMany(Producto::class);
        }
}
