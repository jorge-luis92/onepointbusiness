<?php

namespace App\Http\Controllers;
use App\Models\Producto;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Log;
class ProductoController extends Controller
{
  public function frutas()
  {
    $usuario_actual=\Auth::user();
     if($usuario_actual->type=='Vendedor'){

     return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
      }

      $frutas = DB::table('products')
      ->select('products.id', 'products.unidad_venta', 'products.nombre', 'products.precio', 'products.unidad', 'products.tipo', 'products.stock')
      ->where('products.tipo', '=', 'Fruta')
      ->orWhere('products.tipo', '=', 'Verdura')
      ->orderBy('products.nombre', 'asc')
    ->get();

              return view('productos.frutas', ['fruta' => $frutas]);
  }

  public function agregar_producto()
  {
    $usuario_actual=\Auth::user();
     if($usuario_actual->type=='Vendedor'){

     return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
      }
  //  $productos = DB::table('products')->get();
         return view('productos.agregar');

              //return Datatables::of(User::query())->make(true);

  }

  public function prod_prom()
  {
    $usuario_actual=\Auth::user();
     if($usuario_actual->type=='Vendedor'){

     return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
      }
  //  $productos = DB::table('products')->get();
         return view('productos.promo');

              //return Datatables::of(User::query())->make(true);

  }

      public function create_producto(Request $request)
    {
    /*  $this->validate($request, [
        'nombre' => ['required', 'string', 'max:255', 'unique:products'],
        'tipo' => ['required', 'string', 'max:255'],
        'precio_may' => ['required', 'numeric', 'max:1000'],
        'precio' => ['required', 'numeric', 'max:1000'],
        'unidad' => ['required', 'string', 'max:255'],
        'unidad_venta' => ['required', 'string', 'max:255'],
      ]);*/
      $validator = Validator::make($request->all(), [
        'nombre' => ['required', 'string', 'max:255', 'unique:products'],
        'tipo' => ['required', 'string', 'max:255'],
        'precio_may' => ['required', 'numeric', 'max:1000'],
        'precio' => ['required', 'numeric', 'max:1000'],
        'unidad' => ['required', 'string', 'max:255'],
        'unidad_venta' => ['required', 'string', 'max:255'],
            ]);
  //  return redirect()->route('agregar')->with('success','¡Datos registrados correctamente!');
        if ($validator->passes()) {
          $data = $request;
          $usuario_actual=\Auth::user();
          $nombre_user=$usuario_actual->name;
    $valor_id=  Producto::create([
              'nombre' => $data['nombre'],
              'tipo' => $data['tipo'],
              'precio_may' => $data['precio_may'],
              'precio' => $data['precio'],
              'unidad' => $data['unidad'],
              'unidad_venta' => $data['unidad_venta'],
          ]);

          $valor_id= $valor_id->id;
          $cantidad=0;
          Event::create([
              'id' => $valor_id,
              'nombre_persona' => $nombre_user,
              'producto' => $data['nombre'],
              'tipo_evento' => "Nuevo Producto",
              'cantidad' => $cantidad,
              'motivo' => "Insercción de producto",
          ]);
      return response()->json(['success'=>'Producto Registrado Correctamente.']);
        }
      //  	return response()->json(['error'=>'rSFDDS.']);
        return response()->json(['error'=>$validator->errors()->all()]);

    }

    public function actualizarfruta(Request $request){

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
              ['nombre' => $data['nombre'], 'tipo' => $data['tipo'], 'precio_may' => $data['precio_may'], 'precio' => $data['precio'], 'unidad' => $data['unidad']
            , 'unidad_venta' => $data['unidad_venta']]);
          return redirect()->route('agregar')->with('success','¡Datos actualizados correctamente!');
    }

    public function actualizarpreciof(Request $request){

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
          return redirect()->route('frutas')->with('success','¡El precio se ha actualizado!');
    }

    public function agregar_stock_f(Request $request){

      $this->validate($request, [
        'stock' => ['required', 'numeric', 'min:1', 'max:50000'],
      ]);
      $data = $request;
    // return $data;
$valor = $data['stock'];
Log::info("el valor es: ".$valor);
      $externos=$data['id'];

      $sactual = DB::table('products')
      ->select('products.stock')
      ->where('products.id', $externos)
      ->take(1)
      ->first();
  $sactual= $sactual ->stock;
      $act_s= $sactual + $data['stock'];
if($valor > 0 ){
      DB::table('products')
          ->where('products.id', $externos)
          ->update(
              ['stock' => $act_s]);
          return redirect()->route('frutas')->with('success','¡Se agregó a stock el producto!');
        }
else {

          return redirect()->route('frutas')->with('error','No se insertó ningún valor para agregar en stock');
  }
}

    public function quitar_stock_f(Request $request){

      $this->validate($request, [
        'stock' => ['required', 'numeric', 'min:1', 'max:50000'],
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
          return redirect()->route('frutas')->with('success','¡Se retiró del stock el producto!');
        }
        else {
            return redirect()->route('frutas')->with('error','Está tratando de quitar más de lo que tiene en stock');
        }
    }

    public function getValores(){
      //return Datatables::of(User::query())->make(true);
      return Datatables::of(Producto::select('id','nombre', 'tipo', 'precio_may', 'precio','unidad', 'unidad_venta', 'stock')
      ->where('products.status', '=', 1))
      ->editColumn('precio', function(Producto $gan2){
        $umm= '$ '.$gan2->precio;
        return $umm;
      })
      ->editColumn('stock', function(Producto $gan2){
      $nombres = $gan2->nombre;
        Log::info("Producto nombre: ".$nombres);
        $periodo_semestre = DB::table('products')
      ->select('products.unidad_venta')
      ->where('products.nombre', $nombres)
      ->take(1)
      ->first();
  //    Log::info($periodo_semestre);
    $periodo_semestre= $periodo_semestre->unidad_venta;
    //$periodo_semestre= json_decode( json_encode($periodo_semestre), true);
    $umm= $gan2->stock.' '.$periodo_semestre;
        return $umm;
      })
      ->addColumn('action', function ($user) {
                return '<button class="btn btn-info btn-sm btnEditarP" data-toggle="tooltip" title="Editar">Editar</button>';
            })
            ->addColumn('inversion', function ($user) {
              $nombres = $user->nombre;
              $periodo_semestre = DB::table('products')
            ->select('products.unidad_venta')
            ->where('products.nombre', $nombres)
            ->take(1)
            ->first();
            if(($periodo_semestre->unidad_venta) == 'Gramos'){
              $totalesinv =( ($user->precio_may) * ($user->stock))/1000;
              $totalesinv = round($totalesinv,2);
                      return '$ '.$totalesinv;}
                      else {
                        $totalesinv =($user->precio_may) * ($user->stock);
                        $totalesinv = round($totalesinv,2);
                                return '$ '.$totalesinv;
                      }
                  })
      ->toJson();
    }

    public function getDatosPr($req){
      $valor=$req;

      $consulta = DB::table('products')
         ->select('id','nombre', 'tipo', 'precio_may', 'precio','unidad', 'unidad_venta', 'stock')
         ->where('products.id', $valor)
         ->take(1)
         ->first();
    return json_encode ($consulta);
    }

    public function getedicionproductos(Request $request){

    $data =$request;
    $id =$data['id'];

        $affected = DB::table('products')
                    ->where('id', $id)
                    ->update(
                        ['nombre' => $data['nombre'], 'tipo' => $data['tipo'], 'precio_may' => $data['precio_may'], 'precio' => $data['precio'], 'unidad' => $data['unidad']
                      , 'unidad_venta' => $data['unidad_venta']]);

    }

    public function setaddstock(Request $request)
  {
$usuario_actual=\Auth::user();
//Log::info($request);
    $validator = Validator::make($request->all(), [
      'stock' => ['required', 'numeric', 'min:1', 'max:50000'],
          ]);

          if ($validator->passes()) {
            $data =$request;
            $id =$data['id'];
            $name =$data['user'];
            $stock= $data['stock'];
$usuario_actual=$usuario_actual->name;
            $sactual = DB::table('products')
            ->select('products.stock')
            ->where('products.id', $id)
            ->take(1)
            ->first();
          $sactual= $sactual ->stock;
            $act_s= $sactual + $stock;

              $affected = DB::table('products')
                            ->where('id', $id)
                            ->update(['stock' => $act_s]);
                            Event::create([
                                'id' => $id,
                                'nombre_persona' => $usuario_actual,
                                'producto' => $data['producto'],
                                'tipo_evento' => "Agregación a Stock",
                                'cantidad' => $data['stock'],
                                'motivo' => 'Surtido de mercancía',
                            ]);
  			return response()->json(['success'=>'Se agrego correctamente a stock']);
          }
        	return response()->json(['error'=>'Ingrese una cantidad correcta']);
  }

  public function getValoresquitar(){
    //return Datatables::of(User::query())->make(true);
    return Datatables::of(Producto::select('id','nombre', 'tipo', 'precio_may', 'precio','unidad', 'unidad_venta', 'stock')
    ->where('products.status', '=', 1))
    ->editColumn('precio', function(Producto $gan2){
      $umm= '$ '.$gan2->precio;
      return $umm;
    })
    ->editColumn('stock', function(Producto $gan2){
    $nombres = $gan2->nombre;
    //  Log::info("Producto nombre: ".$nombres);
      $periodo_semestre = DB::table('products')
    ->select('products.unidad_venta')
    ->where('products.nombre', $nombres)
    ->take(1)
    ->first();
//    Log::info($periodo_semestre);
  $periodo_semestre= $periodo_semestre->unidad_venta;
  //$periodo_semestre= json_decode( json_encode($periodo_semestre), true);
  $umm= $gan2->stock.' '.$periodo_semestre;
      return $umm;
    })
    ->addColumn('action', function ($user) {
              return '<button class="btn btn-info btn-sm btnDesactivar" data-toggle="tooltip" title="Desactivar">Desactivar</button>';
          })
          ->toJson();
  }

  public function setquitstock(Request $request)
{
$usuario_actual=\Auth::user();
Log::info($request);
  $validator = Validator::make($request->all(), [
    'stock' => ['required', 'numeric', 'min:1', 'max:50000'],
        ]);

        if ($validator->passes()) {
          $data =$request;
          $id =$data['id'];
          $name =$data['user'];
          $stock= $data['stock'];
$usuario_actual=$usuario_actual->name;
          $sactual = DB::table('products')
          ->select('products.stock')
          ->where('products.id', $id)
          ->take(1)
          ->first();
        $sactual= $sactual ->stock;
          $act_s= $sactual - $stock;

          if($stock <= $sactual){
            $affected = DB::table('products')
                          ->where('id', $id)
                          ->update(['stock' => $act_s]);
                    //  'nombre_persona', 'producto', 'tipo_evento', 'cantidad', 'motivo',
                          Event::create([
                              'id' => $id,
                              'nombre_persona' => $usuario_actual,
                              'producto' => $data['producto'],
                              'tipo_evento' => "Retiro de Stock",
                              'cantidad' => $data['stock'],
                              'motivo' => $data['motivo'],
                          ]);
                  return response()->json(['success'=>'Se retiro correctamente del stock']);
                  }
else {
 return response()->json(['error'=>'No puede quitar más de lo que tiene en stock']);
}
        }
      //  	return response()->json(['error'=>'rSFDDS.']);
        return response()->json(['error'=>'Ingrese una cantidad correcta']);

//return redirect()->route('users')->with('success','¡Datos registrados correctamente!');
}

public function visor_eventos()
{
  $usuario_actual=\Auth::user();
   if($usuario_actual->type=='Vendedor'){
   return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
    }
//  $productos = DB::table('products')->get();
       return view('productos.eventos');
            //return Datatables::of(User::query())->make(true);
}

public function getevents(){
  return Datatables::of(Event::select('id','nombre_persona', 'producto', 'tipo_evento', 'cantidad','motivo', 'created_at'))
  ->editColumn('cantidad', function(Event $gan2){
  $nombres = $gan2->id;
    //Log::info("Producto nombre: ".$nombres);
    $periodo_semestre = DB::table('products')
  ->select('products.unidad_venta')
  ->where('products.id', $nombres)
  ->take(1)
  ->first();
$periodo_semestre= $periodo_semestre->unidad_venta;
//$periodo_semestre= json_decode( json_encode($periodo_semestre), true);
$umm= $gan2->cantidad.' '.$periodo_semestre;
    return $umm;
  })
  ->editColumn('created_at', function(Event $ganancia){
    return $ganancia->created_at->format('d-m-Y h:i A');
  })
  ->toJson();
}

public function desac($ades){
  $valor=$ades;
$uno= 'Se ha desactivado el producto correctamente';
     DB::table('products')
         ->where('products.id', $valor)
         ->update(['status' => 0]);
          return json_encode ($uno);
}


public function ver_desactivados()
{
  $usuario_actual=\Auth::user();
   if($usuario_actual->type=='Vendedor'){

   return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
    }
//  $productos = DB::table('products')->get();
       return view('productos.desactivados');

            //return Datatables::of(User::query())->make(true);

}

public function getValoresactivos(){
  //return Datatables::of(User::query())->make(true);
  return Datatables::of(Producto::select('id','nombre', 'tipo')
  ->where('products.status', '=', 0))
  ->toJson();
}


public function acnew($ades){
  $valor=$ades;
$uno= 'Se ha activado el producto correctamente';
     DB::table('products')
         ->where('products.id', $valor)
         ->update(['status' => 1]);
          return json_encode ($uno);
}

public function otras_acciones(){
   return view('productos.warning');
}


public function prod_prom_data(){
  //return Datatables::of(User::query())->make(true);
  return Datatables::of(Producto::select('id','nombre', 'precio', 'promocion')
  ->where('products.status', '=', 1))

  ->toJson();
}

public function setaddpromo(Request $request)
{
$usuario_actual=\Auth::user();
//Log::info($request);
$validator = Validator::make($request->all(), [
  'stock' => ['required', 'numeric', 'min:0', 'max:50000'],
      ]);

      if ($validator->passes()) {
        $data =$request;
        $id =$data['id'];
        $name =$data['user'];
        $stock= $data['stock'];
$usuario_actual=$usuario_actual->name;

          $affected = DB::table('products')
                        ->where('id', $id)
                        ->update(['promocion' => $stock]);
                        Event::create([
                            'id' => $id,
                            'nombre_persona' => $usuario_actual,
                            'producto' => $data['producto'],
                            'tipo_evento' => "Promoción de producto",
                            'cantidad' => $stock,
                            'motivo' => 'Promoción',
                        ]);
    return response()->json(['success'=>'La promoción del producto ha sido agregada correctamente']);
      }
      return response()->json(['error'=>'Ingrese una cantidad correcta']);
}
}
