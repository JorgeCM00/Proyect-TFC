<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    
    protected $table ="pedidos";

    public function pedidoCliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pedidoProducto(){
        return $this->belongsToMany(Producto::class);
    }
}
