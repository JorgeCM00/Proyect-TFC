<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redes_sociales extends Model
{
    use HasFactory;

    protected $table ="redes_sociales";
    protected $primaryKey="afiliado_user_id";

    public function redesAfiliado()
    {
        return $this->belongsTo(Afiliado::class);
    }

}
