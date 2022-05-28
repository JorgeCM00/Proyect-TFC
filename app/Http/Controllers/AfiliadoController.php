<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Afiliado;
use App\Models\Redes_sociales;
use Illuminate\Support\Facades\DB;

class AfiliadoController extends Controller
{
    public function afiliar($id){
        $user = User::find($id);
        return view('afiliarse',array('user' => $user));
    }

    public function afiliarse(Request $request,$id){
       
        $request->validate([//validaciones, para el CIF y el numero de telefono REALES
            //para instalar el composer: composer require orumad/laravel-spanish-validator 
            'CIF' => 'required|cif',
            'NomEmpresa' => 'required|string|max:255',
            'formaJuridica' => 'required|string|max:30',
            'tlf' => 'required|spanish_phone',
        
        ]);

        $afiliado=Afiliado::find($id);
        if(!$afiliado){
            $afiliado = new Afiliado();
        }
        $afiliado->CIF=$request->CIF;
        $afiliado->nombreEmpresa=$request->NomEmpresa;
        $afiliado->formaJuridica=$request->formaJuridica;
        $afiliado->tlf=$request->tlf;
        $user = User::find($id);
        $user->userAfiliados()->save($afiliado);//creación del afiliado
        $afiliado=Afiliado::find($id);
        $rs=new Redes_sociales;//se crean las RS vacias para poder rellenarlas en el perfil
        $afiliado->afiliadoRedes()->save($rs);
        return view('afiliadoCorrecto');
    }

    public function mostrarAfiliados(){
        //En los seeders al recibir los datos del perfil y que coincidan no me los muestra porque con el seed no va a coincidir casi nunca el afiliado id con el perfil id
        $datosPerfil = Db::table('perfil')->join('afiliados', 'afiliados.user_id','=','perfil.user_id')->orderby('afiliados.created_at','desc')->paginate(5);
        return view('afiliados')->with('datos', $datosPerfil);


    }

    public function darseDeBaja($id){
       
        Afiliado::destroy($id);
        return redirect('/');
    }
}
