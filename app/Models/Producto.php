<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = "productos";


    public function productosAfiliado()
    {
        return $this->belongsTo(Afiliado::class);
    }

    public function etiquetasProduto()
    {
        return $this->belongsToMany(Etiqueta::class);
    }


    public function productoCliente()
    {
        return $this->belongsToMany(Cliente::class);
    }

    public function productoPedido()
    {
        return $this->belongsToMany(Pedido::class);
    }
}
