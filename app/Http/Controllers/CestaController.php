<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CestaController extends Controller
{
    
    /**
     * @param $id
     * @var Producto $producto
     * @var User $cliente
     * @var array $compruebaCesta
     * @var array stockProducto
     * @return redirect
     */
    public function addProducto($id){
        $producto=Producto::find($id);
        $cliente= Auth::user();
        $compruebaCesta=DB::select('select cantidad,cliente_id,producto_id from cestas where cliente_id = ? AND producto_id = ?',[$cliente->id,$producto->id]);
        $stockProducto=DB::select('select stock from productos where id = ? ',[$producto->id]);
        if($stockProducto[0]->stock==0){//comprobación de que el stock del producto que se añade no sea 0
            return ("<script>alert('Se ha agotado el stock del producto, pronto será repuesto')</script>").back();
        }
        if($compruebaCesta){
        if($compruebaCesta[0]->cantidad >= $stockProducto[0]->stock){//Comprobación de que la cantidad de la cesta no supere la del producto
            
            return ("<script>alert('Estás superando el stock actual del producto')</script>").back();
           
        }else{
        DB::table('cestas')->where('cliente_id',$cliente->id)->where('producto_id',$producto->id)->update(['cantidad'=>++$compruebaCesta[0]->cantidad]);//actializa la cantidad de los productos
        
        }}else{

         DB::insert('INSERT into cestas(producto_id, cliente_id, cantidad) values (?, ?, 1)',[$producto->id,$cliente->id]);//Inserta los datos

        }
    
        return back();

    }

    /**
     * @param $id
     * @var cliente $cliente
     * @var array $datosCesta
     * @return view con datos de datosCesta
     */
    public function obtenerCesta($id){
        $cliente=Cliente::find($id);
        $datosCesta=DB::table('cestas')->join('productos','productos.id','=','cestas.producto_id')->where('cliente_id','=',$cliente->user_id)->get();
        return view('verCesta')->with('datosCesta', $datosCesta);
    }
    /**
     * @param $id
     * @var Producto $producto
     * @return redirect
     */
    public function borrarProductoCesta($id){
        $producto=DB::table('cestas')->where('producto_id','=',$id);
        $producto->delete();
        return back();
    }
    /**
     * @param Request $request
     * @param $id
     * @var Cliente $cliente
     * @var Pedido $pedido
     * @var array $datosCesta
     * @var $insercion
     * @var $restaStock
     * @return view
     */
    public function pagar(Request $request,$id){

        $request->validate([
            'pago' => 'required',
        ]);

        $cliente=Cliente::find($id);
        $cliente->metodoPago=$request->pago;
        $cliente->save();
        $pedido=new Pedido();
        $pedido->precioTot=$request->precioTot;
        $cliente->clientePedido()->save($pedido);
        $datosCesta=DB::table('cestas')->where('cliente_id','=',$cliente->user_id)->get();
        foreach ($datosCesta as $producto) {
            //inserta los datos del producto_pedido
            $insercion=DB::insert('INSERT into producto_pedido(pedido_id,producto_id, cantidad) values (?, ?, ? )',[$pedido->id,$producto->producto_id,$producto->cantidad]); 
            //Resta al  stock del producto que se compra la cantidad comprada 
            $restaStock= DB::update('UPDATE productos set stock = stock - ? where id= ?',[$producto->cantidad,$producto->producto_id]);
        }
        if($insercion){
            $producto=DB::table('cestas')->where('cliente_id','=',$cliente->user_id);//borra la cesta
            $producto->delete();
            return view('compraRealizada');
        }
        else abort(403,'Hubo algún problema al recibir los datos de compra');
    }
}
