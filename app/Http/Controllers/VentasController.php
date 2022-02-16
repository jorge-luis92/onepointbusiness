<?php

namespace App\Http\Controllers;

use App\Models\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Detailsale;
use App\Models\Sale;
use App\Models\Impresions;
use Log;
use Yajra\DataTables\DataTables;
use Carbon\carbon;
class VentasController extends Controller
{

public function ventas_inicio(){
  $frutas = DB::table('products')
  ->select('products.id','products.nombre', 'products.precio', 'products.unidad_venta', 'products.tipo', 'products.stock')
  ->where('products.status', '=', 1)
->orderBy('products.nombre', 'asc')
 ->get();
$usuario_actual=\Auth::user();
$id= $usuario_actual->id;
  $date = Carbon::now();

 $users = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->join('users', 'users.id', '=', 'sales.id_user')
 ->where('users.id', '=', $id)
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.total');
 $users = round($users,2);

 $ganas = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->join('users', 'users.id', '=', 'sales.id_user')
 ->where('users.id', '=', $id)
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.ganancias');
 $ganas = round($ganas,2);
 //Log::info($users);
          return view('ventas.ventas', ['producto' => $frutas, 'pago' => $users, 'ganacias_dia' => $ganas]);
}

public function ventas_pro(){
  $frutas = DB::table('products')
  ->select('products.id','products.nombre', 'products.precio', 'products.unidad_venta', 'products.tipo', 'products.stock')
  ->where('products.status', '=', 1)
->orderBy('products.nombre', 'asc')
 ->get();
$usuario_actual=\Auth::user();
$id= $usuario_actual->id;
  $date = Carbon::now();

 $users = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->join('users', 'users.id', '=', 'sales.id_user')
 ->where('users.id', '=', $id)
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.total');
 $users = round($users,2);

 $ganas = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->join('users', 'users.id', '=', 'sales.id_user')
 ->where('users.id', '=', $id)
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.ganancias');
 $ganas = round($ganas,2);
 //Log::info($users);
          return view('ventas.ventas_pro', ['producto' => $frutas, 'pago' => $users, 'ganacias_dia' => $ganas]);
}


public function datosenviados(Request $request){
  $usuario_actual=\Auth::user();
  $datos= $request;
  $id_user=$usuario_actual->id;
  $total_de_venta = $datos['precio'];
  $totalregistros = Detailsale::count();
  $sale_id =  Sale::create([
      'id_user' => $id_user,
      'totalventa' => $total_de_venta,
  ]);

  $hola= $sale_id->id;
  //Log::info($hola);
  $date = Carbon::now();
  $date = $date->format('Y-m-d');

 foreach($datos['data'] as  $dato) {
  Log::info($dato);
  $buscid= $dato['id'];
  $gram_a_quitar = DB::table('products')->find($buscid);
  $gram_a = $dato['gramos'];
  $precio_may = $gram_a_quitar->precio_may;
    $precio_pub = $gram_a_quitar->precio;
    Detailsale::create([
      'id' => $hola,
      'produto' => $dato['nombre'],
      'tipo' => $dato['tipo'],
      'cantidad_vendida' => $dato['gramos'],
      'total' => $dato['totaltempo'],
      'precio_may' => $precio_may,
      'precio_pub' => $precio_pub,
      'ganancias' => $dato['ganancias'],
      'creacion' => $date,
  ]);
//  $gram_a_quitar = DB::table('products')->find($buscid);
  $dim_gramos = ($gram_a_quitar->stock) - $gram_a;
  DB::table('products')
                ->where('id', $buscid)
                ->update(['stock' => $dim_gramos]);
}

}

public function ventas_registros(){

  $usuario_actual=\Auth::user();
   if($usuario_actual->type=='Vendedor'){

   return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
    }

  $ventas_reg = DB::table('detailsales')
  ->select('products.unidad_venta', 'detailsales.produto','detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_pub', 'detailsales.precio_may',
  'detailsales.ganancias', 'detailsales.created_at')
  ->join('products', 'products.nombre', '=', 'detailsales.produto')
 ->simplePaginate(10);


 $users = DB::table('detailsales')
 ->sum('detailsales.total');
$users = round($users,2);
 $ganas = DB::table('detailsales')
 ->sum('detailsales.ganancias');
 $ganas = round($ganas,2);

          return view('ventas.registross', ['registros_ventas' => $ventas_reg, 'pago' => $users, 'ganacias_dia' => $ganas]);

}

public function getReger(){
  //return Datatables::of(User::query())->make(true);

 return Datatables::of(Detailsale::select('products.unidad_venta','detailsales.produto','detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_pub', 'detailsales.precio_may',
  'detailsales.ganancias', 'detailsales.created_at')
  ->join('products', 'products.nombre', '=', 'detailsales.produto'))
  ->editColumn('created_at', function(Detailsale $ganancia){
    return $ganancia->created_at->format('d-m-Y h:i A');
  })->toJson();



}

public function getmisventas(){
  $usuario_actual=\Auth::user();
  $date = Carbon::now();
  $data_venta = Detailsale::join('sales', 'sales.id', '=', 'detailsales.id')
                     ->join('users', 'users.id', '=', 'sales.id_user')
                     ->whereDate('detailsales.created_at', $date)
                     ->select(['detailsales.produto', 'detailsales.created_at', 'detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_may', 'detailsales.precio_pub', 'detailsales.ganancias']);

                     return Datatables::of($data_venta)
                     ->editColumn('created_at', function(Detailsale $ganancia){
                       return $ganancia->created_at->format('d-m-Y h:i A');
                     })
                     ->editColumn('precio_may', function(Detailsale $gan1){
                       $umm= '$ '.$gan1->precio_may;
                       return $umm;
                     })
                     ->editColumn('total', function(Detailsale $gan2){
                       $umm= '$ '.$gan2->total;
                       return $umm;
                     })
                     ->editColumn('precio_pub', function(Detailsale $gan2){
                       $umm= '$ '.$gan2->precio_pub;
                       return $umm;
                     })
                     ->editColumn('ganancias', function(Detailsale $gan2){
                       $umm= '$ '.$gan2->ganancias;
                       return $umm;
                     })
                     ->editColumn('cantidad_vendida', function(Detailsale $gan2){
                     $nombre = $gan2->produto;
                       $periodo_semestre = DB::table('products')
                     ->select('products.unidad_venta')
                     ->where('products.nombre', $nombre)
                     ->take(1)
                     ->first();
                     $periodo_semestre= $periodo_semestre->unidad_venta;
                       $umm= $gan2->cantidad_vendida.' '.$periodo_semestre;
                       return $umm;
                     })
                     ->toJson();
}

public function registros_espec(){
  $usuario_actual=\Auth::user();
   if($usuario_actual->type=='Vendedor'){

   return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
    }
          return view('ventas.registros_especificos');
}

public function busqueda_realizada($req){
  $date=$req;
/*  $data_venta = DB::table('detailsales')
   ->select('detailsales.produto', 'detailsales.created_at', 'detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_may', 'detailsales.precio_pub', 'detailsales.ganancias')
   ->whereDate('detailsales.creacion', $date)
   ->get();



   return Datatables::of($data_venta)
   ->toJson();
*/
//Log::info($date);

   return Datatables::of(Detailsale::select('produto','cantidad_vendida', 'total', 'precio_pub', 'precio_may', 'ganancias', 'created_at')
   ->whereDate('detailsales.creacion', $date))
   ->editColumn('created_at', function(Detailsale $ganancia){
     return $ganancia->created_at->format('d-m-Y h:i A');
   })
   ->editColumn('cantidad_vendida', function(Detailsale $gan2){
   $nombre = $gan2->produto;
     $periodo_semestre = DB::table('products')
   ->select('products.unidad_venta')
   ->where('products.nombre', $nombre)
   ->take(1)
   ->first();
   $periodo_semestre= $periodo_semestre->unidad_venta;
     $umm= $gan2->cantidad_vendida.' '.$periodo_semestre;
     return $umm;
   })
   ->toJson();

}

public function busqueda_realizada_prueba($req, $tipo){
  $date=$req;
//$fecha = $date;
$type= $tipo;
if($type == 'General'){

  return Datatables::of(Detailsale::select('products.unidad_venta', 'detailsales.produto','detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_pub', 'detailsales.precio_may',
  'detailsales.ganancias', 'detailsales.created_at')
  ->join('products', 'products.nombre', '=', 'detailsales.produto')
  ->whereDate('detailsales.created_at', $date))
  ->editColumn('created_at', function(Detailsale $ganancia){
    return $ganancia->created_at->format('d-m-Y h:i A');
  })
  ->toJson();
}
if($type == 'Fruta'){
            $datos_ventas= DB::table('detailsales')
                                 ->join('products', 'products.nombre', '=', 'detailsales.produto')
                                 ->where('products.tipo', '=', 'Fruta')
                                 ->whereDate('detailsales.created_at', $date)
->select(['products.unidad_venta', 'detailsales.produto','detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_pub',
'detailsales.precio_may', 'detailsales.ganancias', 'detailsales.created_at']);

                $union= DB::table('detailsales')
                                ->join('products', 'products.nombre', '=', 'detailsales.produto')
                                 ->where('products.tipo', '=', 'Verdura')
                                 ->whereDate('detailsales.created_at', $date)
->select(['products.unidad_venta', 'detailsales.produto','detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_pub', 'detailsales.precio_may',
'detailsales.ganancias', 'detailsales.created_at'])
                                 ->union($datos_ventas);

         return Datatables::of($union)
         ->toJson();

        }
else {

                   return Datatables::of(Detailsale::select('products.unidad_venta', 'detailsales.produto','detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_pub', 'detailsales.precio_may',
                   'detailsales.ganancias', 'detailsales.created_at')
                   ->join('products', 'products.nombre', '=', 'detailsales.produto')
                   ->where('products.tipo', '=', $type)
                   ->whereDate('detailsales.created_at', $date))
                   ->editColumn('created_at', function(Detailsale $ganancia){
                     return $ganancia->created_at->format('d-m-Y h:i A');
                   })
                   ->toJson();
}
}

public function revpro($req){
  $valor=$req;

  $consulta = DB::table('products')
     ->select('products.unidad_venta', 'products.precio', 'products.promocion')
     ->where('products.id', $valor)
     ->take(1)
     ->first();

  return json_encode ($consulta);

}

public function getventastoday(){


$usuario_actual=\Auth::user();
  $date = Carbon::now();

 $users = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.total');
 $users = round($users,2);

 $ganas = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.ganancias');
 $ganas = round($ganas,2);

 //Log::info($users);
          return view('ventas.diasventas', ['pago' => $users, 'ganacias_dia' => $ganas]);

}

public function ventas_extra(){
  $frutas = DB::table('products')
  ->select('products.id','products.nombre', 'products.precio', 'products.unidad_venta', 'products.tipo', 'products.stock')
  ->where('products.status', '=', 1)
->orderBy('products.nombre', 'asc')
 ->get();
$usuario_actual=\Auth::user();
$id= $usuario_actual->id;
  $date = Carbon::now();

 $users = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->join('users', 'users.id', '=', 'sales.id_user')
 ->where('users.id', '=', $id)
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.total');
 $users = round($users,2);

 $ganas = DB::table('detailsales')
 ->join('sales', 'sales.id', '=', 'detailsales.id')
 ->join('users', 'users.id', '=', 'sales.id_user')
 ->where('users.id', '=', $id)
 ->whereDate('detailsales.created_at', $date)
 ->sum('detailsales.ganancias');
 $ganas = round($ganas,2);
 //Log::info($users);
          return view('ventas.venta_extraoficial', ['producto' => $frutas, 'pago' => $users, 'ganacias_dia' => $ganas]);
}

public function datosenviados_impresiones(Request $request){
  $datos= $request;
  $date = Carbon::now();
  $date = $date->format('Y-m-d');

  $total_de_venta = $datos['total_impresiones'];
  $sale_id =  Impresions::create([
      'total_impresiones' => $total_de_venta,
      'creacion_impresiones' => $date,
  ]);

}

public function busqueda_dia_impresiones($req){
  $date=$req;
Log::info($date);
  return Datatables::of(Impresions::select('impresions.total_impresiones', 'impresions.created_at')
  ->whereDate('impresions.created_at', $date))
  ->editColumn('created_at', function(Impresions $fecha){
    return $fecha->created_at->format('d-m-Y h:i A');
  })
  ->toJson();


}

}
