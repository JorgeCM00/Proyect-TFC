<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Redes_sociales;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function verPerfil($id)
    {
        $user = User::find($id);
        $datosPerfil = DB::select('select p.user_id,p.foto, p.descripcion, p.pais, p.ciudad,p.CP,p.calle_numero,p.piso_puerta_bloque, u.nombre, u.email, u.apellidos from perfil p JOIN users u ON p.user_id=u.id where id=?', [$user->id]);
        $afiliado = Afiliado::find($id);
        if (!$afiliado) {//Si un usuario es afiliado o no muestra una vista para cada uno
            return view('verPerfil', array('datosPerfil' => $datosPerfil));
        } else {
            $datosAfiliado = DB::select('select a.user_id, a.CIF, a.nombreEmpresa, a.formaJuridica, a.tlf, r.bio, r.twitter, r.insta   from afiliados a JOIN redes_sociales r ON a.user_id=r.afiliado_user_id where user_id=?', [$afiliado->user_id]);
            return view('verPerfilAfiliado', array('datosPerfil' => $datosPerfil), array('datosAfiliado' => $datosAfiliado));
        }
    }

    public function editarPerfil($id)
    {
        $user = User::find($id);
        $datosPerfil = DB::select('select p.user_id,p.foto, p.descripcion, p.pais, p.ciudad,p.CP,p.calle_numero,p.piso_puerta_bloque, u.nombre, u.email, u.apellidos from perfil p JOIN users u ON p.user_id=u.id where id=?', [$user->id]);
        $afiliado = Afiliado::find($id);
        if (!$afiliado) {//Si un usuario es afiliado o no muestra una vista para cada uno
            return view('editarPerfil', array('datosPerfil' => $datosPerfil));
        } else {
            $datosAfiliado = DB::select('select a.user_id, a.CIF, a.nombreEmpresa, a.formaJuridica, a.tlf, r.bio, r.twitter, r.insta    from afiliados a JOIN redes_sociales r ON a.user_id=r.afiliado_user_id where user_id=?', [$afiliado->user_id]);
            return view('editarPerfilAfiliado', array('datosPerfil' => $datosPerfil), array('datosAfiliado' => $datosAfiliado));
        }
    }

    //metodo que es llamado por ajax para recibir el nombre de la imagen y moverlo a la carpeta correspondiente con el formato que queramos
    public function upload(Request $request)
    {
        $perfil = Perfil::find(Auth::user()->id);
        $perfil->foto = $request->file('image')->getClientOriginalName();
        $perfil->ruta = $request->file('image')->move(public_path('imagenes'), Auth::user()->id . '.jpeg');//recibe los datos de la imagen y los mueve a la carpeta imagen con la nomenclatura definida
        $perfil->save();
        return response()->json('okey');
    }
    public function edicion(Request $request, $id)
    {

        $request->validate([ //validaciones para el CP REALES
            //para instalar el composer: composer require orumad/laravel-spanish-validator 
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'descripcion' => 'required|string|max:2000',
            'pais' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'CP' => 'required|spanish_postal_code',
            'calle' => 'required|string|max:255',
            'piso' => 'required|string|max:255',
            
        ]);
        $perfil = Perfil::find($id);
        $user = User::find($id);
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $perfil->descripcion = $request->descripcion; //cambios para la tabla perfil
        $perfil->pais = $request->pais;
        $perfil->ciudad = $request->ciudad;
        $perfil->CP = $request->CP;
        $perfil->calle_numero = $request->calle;
        $perfil->piso_puerta_bloque = $request->piso;
        $user->perfil()->save($perfil); //datos guardados
        $user->save();
        if (isset($request->afiliado_id)) { //En caso de que el usuario sea recibe e introduce los datos para sus redes sociales
            $afiliado = Afiliado::find($id);
            $rs = Redes_sociales::find($id);
            $rs->bio = $request->bio;
            $rs->twitter = $request->twitter;
            $rs->insta = $request->insta;
            $afiliado->afiliadoRedes()->save($rs);
        }
        return view('edicionCorrecta');
    }
}
