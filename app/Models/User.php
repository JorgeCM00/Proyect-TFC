<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'nombre',
        'apellidos',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userClientes()
    {
        return $this->hasOne(Cliente::class);
    }

    public function userAfiliados()
    {
        return $this->hasOne(Afiliado::class);
    }

    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    public function esAfiliado()
    {
        $afiliado = DB::select('select user_id from afiliados where user_id = ?', [Auth::user()->id]);
        if ($afiliado) {
            return true;
        } else {
            return false;
        }
    }
    public function getPerfil()
    {
        $perfil = DB::select('select * from perfil where user_id = ?', [Auth::user()->id]);

        return $perfil;
    }
}
