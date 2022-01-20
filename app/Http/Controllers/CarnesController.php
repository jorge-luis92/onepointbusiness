<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CarnesController extends Controller
{
  public function carneslac()
  {
    $usuario_actual=\Auth::user();
     if($usuario_actual->type=='Vendedor'){

     return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
      }
      $frutas = DB::table('products')
      ->select('products.id','products.nombre', 'products.precio', 'products.unidad', 'products.tipo', 'products.stock', 'products.unidad_venta')
      ->where('products.tipo', '=', 'Carne')
      ->orWhere('products.tipo', '=', 'Lacteo')
      ->orderBy('products.nombre', 'asc')
    ->get();

              return view('productos.carneslac', ['fruta' => $frutas]);
  }


    public function actualizarcarne(Request $request){

      $this->validate($request, [
        'nombre' => ['required', 'string', 'max:255'],
        'tipo' => ['required', 'string', 'max:255'],
        'precio' => ['required', 'numeric', 'max:1000'],
      ]);
      $data = $request;
    //  return $data;
      $externos=$data['id'];
      DB::table('products')
          ->where('products.id', $externos)
          ->update(
              ['nombre' => $data['nombre'], 'tipo' => $data['tipo'], 'precio' => $data['precio'], 'unidad' => $data['unidad']]);
          return redirect()->route('carnes')->with('success','¡Datos actualizados correctamente!');
    }

    public function actualizarpreciocl(Request $request){

      $this->validate($request, [
        'precio' => ['required', 'numeric', 'max:1000'],
      ]);
      $data = $request;
    //  return $data;
      $externos=$data['id'];
      DB::table('products')
          ->where('products.id', $externos)
          ->update(
              ['precio' => $data['precio']]);
          return redirect()->route('carnes')->with('success','¡El precio se ha actualizado!');
    }

    public function agregar_stock_cl(Request $request){

      $this->validate($request, [
        'stock' => ['required', 'numeric',  'min:1', 'max:50000'],
      ]);
      $data = $request;
    //  return $data;
      $externos=$data['id'];

      $sactual = DB::table('products')
      ->select('products.stock')
      ->where('products.id', $externos)
      ->take(1)
      ->first();
  $sactual= $sactual ->stock;
      $act_s= $sactual + $data['stock'];
$valor = $data['stock'];
      if($valor > 0 ){
        DB::table('products')
            ->where('products.id', $externos)
            ->update(
                ['stock' => $act_s]);
            return redirect()->route('carnes')->with('success','¡Se agregó a stock el producto!');
              }
      else {

                return redirect()->route('carnes')->with('error','No se insertó ningún valor para agregar en stock');
        }

    }

    public function quitar_stock_cl(Request $request){

      $this->validate($request, [
        'stock' => ['required', 'numeric',  'min:1', 'max:50000'],
      ]);
      $data = $request;
    //  return $data;
      $externos=$data['id'];

      $sactual = DB::table('products')
      ->select('products.stock')
      ->where('products.id', $externos)
      ->take(1)
      ->first();
    $sactual= $sactual ->stock;
      $act_s= $sactual - $data['stock'];
          $valor = $data['stock'];
    if($valor <= $sactual){
          DB::table('products')
              ->where('products.id', $externos)
              ->update(
                  ['stock' => $act_s]);
              return redirect()->route('carnes')->with('success','¡Se retiró del stock el producto!');
            }
            else {
                return redirect()->route('carnes')->with('error','Está tratando de quitar más de lo que tiene en stock');
            }
    }

}
