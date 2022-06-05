<?php

namespace App\Http\Controllers;

use App\Models\Afiliado;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Etiqueta;

class ProductosController extends Controller
{
    /**
     * @param $id
     * @var Etiquetas $etiquetas
     * @var Afiliada $afiliado
     * @return view
     */
    public function crearProductos($id)
    {
        $etiquetas = Etiqueta::all();
        $afiliado = Afiliado::find($id);
        return view('crearProducto', array('afiliado' => $afiliado), array('etiquetas' => $etiquetas));
    }

    /**
     * @var Producto $datosTienda
     * @return view 
     */
    public function mostrarTienda()
    {
        $datosTienda = Producto::orderby('created_at', 'desc')->paginate(5);
        return view('tienda')->with('datosTienda', $datosTienda);
    }

    /**
     * @param $id
     * @var array $datosTienda
     * @return view 
     */
    public function listaProductos($id)
    {
        $datosTienda = DB::select('select id, afiliado_id,nombre,descripcion,imagen,precio from productos where afiliado_id=?', [$id]);
        return view('misProductos', array('datosTienda' => $datosTienda));
    }

    /**
     * @param $producto_id
     * @var Producto $producto
     * @var Etiqueta $etiquetas
     * @var array $etiquetas_marcada
     * @var $marcada
     * @var array $arrayMarcadas
     * @return view
    */
    public function gestionarProducto($producto_id)
    {
        $producto = Producto::find($producto_id);
        $etiquetas = Etiqueta::all();
        $etiquetas_marcadas = DB::table('etiqueta_producto')->where('producto_id', '=', $producto->id)->get('etiqueta_id');
        $marcada=$etiquetas_marcadas->all();//recibimos todas las etiquetas como coleccion
        $arrayMarcadas=array();//las hacemos array
        foreach($marcada as $m){
            $arrayMarcadas[]=$m->etiqueta_id;//lo recorremos para obtener el id individual tal que (1)
        }
        return view('gestionProducto', [
            'producto' => $producto,
            'etiquetas' => $etiquetas,
            'etiquetas_marcadas'=>$arrayMarcadas,
        ]);

    }


    /**
     * @param Request $request
     * @return json
     */
    public function subir(Request $request)
    {
        //A diferencia del perfil aqui el producto no está creado 

        $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('productos'), Auth::user()->id . 'temporal' . '.jpeg');//sube la foto la mueve y le pone el nombre

        return response()->json('okey');
    }

    /**
     * @param Request $request
     * @var Producto $producto
     * @return json
     */
    public function editar(Request $request)//edita la foto recibiendo una nueva y la renombra sustituyendo  la anterior 
    {
        $producto = Producto::find($request->producto_id);
        $producto->imagen = $producto->id . '_' . Auth::user()->id . '.jpeg';
        $producto->ruta = $request->file('image')->move(public_path('productos'), $producto->id . '_' . Auth::user()->id . '.jpeg');//
        $producto->save();
        return response()->json('okey');
    }

    /**
     * @param Request $request
     * @param $id
     * @var Afiliado $afiliado
     * @var Producto $producto
     * @var $id_producto
     * @var Etiqueta $etiquetas
     * @return view
     */
    public function creacionProducto(Request $request, $id)
    {

        $request->validate([ //validaciones
            'nombre' => 'required|string|max:255',
            'descripcion' => 'string|max:2000',
            'stock' => 'int',
            'IVA' => 'string|max:20',
            'precio' => 'int',

        ]);
        $afiliado = Afiliado::find($id);
        $producto = new Producto();
        $producto->imagen = "Producto.jpeg";
        $producto->ruta = "public/productos/";
        $producto->nombre = $request->nombre;      
        $producto->descripcion = $request->descripcion; 
        $producto->stock = $request->stock;
        $producto->IVA = $request->IVA;
        $producto->precio = $request->precio;
        $afiliado->afiliadoProductos()->save($producto); //datos guardados
        if (file_exists(public_path('productos/' . Auth::user()->id . 'temporal' . '.jpeg'))){
        $id_producto = DB::select('select MAX(id) id from productos where afiliado_id=?', [Auth::user()->id]);
        //renombra la imagen obteniendo el id del último producto introducido
        rename(public_path('productos/' . Auth::user()->id . 'temporal' . '.jpeg'), public_path('productos/' . $id_producto[0]->id . '_' . Auth::user()->id . '.jpeg'));
        $producto = Producto::find($id_producto[0]->id);
        $producto->imagen = $id_producto[0]->id . '_' . Auth::user()->id . '.jpeg';
        $producto->ruta = 'public/productos/' . $id_producto[0]->id . '_' . Auth::user()->id . '.jpeg';
        $producto->save();
    }
        if ($producto) {//una vez guardado el producto guarda las etiquetas que se marcaron en el producto
            if (!empty($request->input('etiquetas'))) {
                foreach ($request->input('etiquetas') as $etiquetas_ID) {

                    $etiquetas = new Etiqueta();
                    $etiquetas->id = $etiquetas_ID;
                    $producto->etiquetasProduto()->attach($etiquetas);//crea la tabla etiqueta_producto con el metodo attach
                }
            }
        }
        return view('productoCorrecto');
    }

    /**
     * @param Request $reqiest
     * @param $producto_id
     * @var Producto $producto
     * @var borrarEtiqueta
     * @var Etiqueta $etiquetas
     * @return view
     */
    public function editarProducto(Request $request, $producto_id)
    {
        $producto = Producto::find($producto_id);
        $producto->nombre = $request->nombre;      
        $producto->descripcion = $request->descripcion; 
        $producto->stock = $request->stock;
        $producto->IVA = $request->IVA;
        $producto->precio = $request->precio;
        $producto->save();
        if ($producto) {
            if (!empty($request->input('etiquetas'))) { //Compueba que haya etiquetas marcadas ya que sin esto si el request->etiquetas estuviese vacio daría error.
                $borrarEtiqueta = DB::table('etiqueta_producto')->where('producto_id', '=', $producto->id)->delete();
                foreach ($request->input('etiquetas') as $etiquetas_ID) { //se recorre el array de etiquetas para saber que o cuales etiquetas han sido marcadas          
                    $etiquetas = new Etiqueta();
                    $etiquetas->id = $etiquetas_ID;
                    $producto->etiquetasProduto()->attach($etiquetas->id); //y mediante un attach se hace la insercion en la tabla Nodo_etiquetas
                }
            }
        }
        return view('productoCorrecto');
    }

    /**
     * @param $producto_id
     * @var Producto $producto
     * @var $image_path
     * @return view
     */
    public function borrar($producto_id)
    {
        $producto = Producto::find($producto_id);
        $image_path = public_path() . '/productos/' . $producto->imagen; //seleccionamos la imagen que queremos eliminar (le pasamos el nombre del producto a eliminar)
        if (@getimagesize($producto->imagen)) {
            unlink($image_path); //Se elimina
        }
        Producto::destroy($producto_id);
        return view('productoBorrado');
    }
    /**
     * @param $id
     * @var Producto $productos
     * @return view
     */
    public function productosAfiliado($id)
    {
        $productos = Producto::where('afiliado_id', '=', $id)->orderby('created_at', 'desc')->paginate(5);
        return view('verProductoAfiliado', array('productos' => $productos));
    }
}
