<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";
    protected $primaryKey = "user_id";

    public function clienteUsuario()
    {
        return $this->belongsTo(User::class);
    }

    public function ClienteProducto()
    {
        return $this->belongsToMany(Producto::class);
    }

    public function clientePedido()
    {
        return $this->hasOne(Pedido::class);
    }
}
