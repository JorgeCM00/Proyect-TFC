<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Afiliado extends Model
{
    use HasFactory;

    protected $table="afiliados";
    protected $primaryKey="user_id";
    
    public function afiliadoUsuario()
    {
        return $this->belongsTo(User::class);
    }

    public function afiliadoRedes() {
        return $this->hasOne(Redes_sociales::class);
    }

    public function afiliadoProductos() {
        return $this->hasMany(Producto::class,'afiliado_id');
    }

}
