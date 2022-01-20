<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Detailsale;
use App\Models\Sale;
use Log;
use Yajra\DataTables\DataTables;
use Carbon\carbon;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
//use Excel;
use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;

class DownloadController extends Controller
{

  public  function users(){

      return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function downus(){
      $ids ='3';
      $data = DB::table('users')
         ->select('users.id', 'users.name', 'users.email')
         ->where('users.id', '=', $ids)
         ->take(1)
         ->first();
      return Excel::download($data, 'users.xlsx');
    }

    public function descarga_datos($fecha, $tipo){

$types = $tipo;
$date = $fecha;

/*$ganas = DB::table('detailsales')
->join('sales', 'sales.id', '=', 'detailsales.id')
->whereDate('detailsales.created_at', $date)
->sum('detailsales.ganancias');
$ganas = round($ganas,2);
*/
if($types == 'General'){
$datos_ventas = DB::table('detailsales')
         ->join('products', 'products.nombre', '=', 'detailsales.produto')
           ->select('products.unidad_venta', 'detailsales.produto', 'detailsales.created_at', 'detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_may', 'detailsales.precio_pub', 'detailsales.ganancias')
        ->whereDate('detailsales.created_at', $date)
        ->get();

        $ganas = DB::table('detailsales')
        ->whereDate('detailsales.created_at', $date)
        ->sum('detailsales.ganancias');


        $totales = DB::table('detailsales')
        ->whereDate('detailsales.created_at', $date)
        ->sum('detailsales.total');

                   $paper_orientation = 'letter';
                   $customPaper = array(2.5,2.5,600,950);
$valetio = 'Fecha_ '.$date.'_tipo de reporte_ '.$types.'.pdf';
   $pdf = PDF::loadView('ventas.pdf_prueba', ['dato' =>  $datos_ventas, 'total' => $totales, 'ganancia' => $ganas, 'tipo' => $types])
  ->setPaper($customPaper,$paper_orientation);
   return $pdf->stream($valetio);
    }

    if($types == 'Fruta'){

      $datos_ventas = DB::table('detailsales')
        ->join('products', 'products.nombre', '=', 'detailsales.produto')
        ->select('products.unidad_venta', 'detailsales.produto', 'detailsales.created_at', 'detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_may', 'detailsales.precio_pub', 'detailsales.ganancias')
        ->where('products.tipo', '=', 'Fruta')
        ->whereDate('detailsales.created_at', $date);

      $union = DB::table('detailsales')
          ->join('products', 'products.nombre', '=', 'detailsales.produto')
        ->select('products.unidad_venta', 'detailsales.produto', 'detailsales.created_at', 'detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_may', 'detailsales.precio_pub', 'detailsales.ganancias')
        ->where('products.tipo', '=', 'Verdura')
       ->whereDate('detailsales.created_at', $date)
       ->union($datos_ventas)
       ->get();

              $ganas_fr = DB::table('detailsales')
              ->join('products', 'products.nombre', '=', 'detailsales.produto')
              ->where('products.tipo', '=', 'Fruta')
              ->whereDate('detailsales.created_at', $date)
              ->sum('detailsales.ganancias');

              $ganas_ve = DB::table('detailsales')
              ->join('products', 'products.nombre', '=', 'detailsales.produto')
              ->where('products.tipo', '=', 'Verdura')
              ->whereDate('detailsales.created_at', $date)
              ->sum('detailsales.ganancias');

             $ganas = $ganas_fr + $ganas_ve;

              $total_fr = DB::table('detailsales')
              ->join('products', 'products.nombre', '=', 'detailsales.produto')
              ->where('products.tipo', '=', 'Fruta')
              ->whereDate('detailsales.created_at', $date)
              ->sum('detailsales.total');

              $total_ve = DB::table('detailsales')
              ->join('products', 'products.nombre', '=', 'detailsales.produto')
              ->where('products.tipo', '=', 'Verdura')
              ->whereDate('detailsales.created_at', $date)
              ->sum('detailsales.total');

              $totales = $total_fr + $total_ve;
              $typos = 'Frutas y Verduras';
$valetio = 'Fecha_ '.$date.'_tipo de reporte_frutas_verduras.pdf';
                         $paper_orientation = 'letter';
                         $customPaper = array(2.5,2.5,600,950);

         $pdf = PDF::loadView('ventas.pdf_prueba', ['dato' =>  $union, 'total' => $totales, 'ganancia' => $ganas, 'tipo' => $typos])
        ->setPaper($customPaper,$paper_orientation);
         return $pdf->stream($valetio);
    }else {
      $datos_ventas = DB::table('detailsales')
                ->join('products', 'products.nombre', '=', 'detailsales.produto')
                 ->select('products.unidad_venta', 'detailsales.produto', 'detailsales.created_at', 'detailsales.cantidad_vendida', 'detailsales.total', 'detailsales.precio_may', 'detailsales.precio_pub', 'detailsales.ganancias')
                  ->where('products.tipo', '=', $types)
              ->whereDate('detailsales.created_at', $date)
              ->get();

              $ganas = DB::table('detailsales')
              ->join('products', 'products.nombre', '=', 'detailsales.produto')
              ->where('products.tipo', '=', $types)
              ->whereDate('detailsales.created_at', $date)
              ->sum('detailsales.ganancias');
            //  $ganas = round($ganas,2);

              $totales = DB::table('detailsales')
              ->join('products', 'products.nombre', '=', 'detailsales.produto')
              ->where('products.tipo', '=', $types)
              ->whereDate('detailsales.created_at', $date)
              ->sum('detailsales.total');
              //$totales = round($ganas,2);
                         $paper_orientation = 'letter';
                         $customPaper = array(2.5,2.5,600,950);
$valetio = 'Fecha_ '.$date.'_tipo de reporte_ '.$types.'s'.'.pdf';
         $pdf = PDF::loadView('ventas.pdf_prueba', ['dato' =>  $datos_ventas, 'total' => $totales, 'ganancia' => $ganas, 'tipo' => $types])
        ->setPaper($customPaper,$paper_orientation);
         return $pdf->stream($valetio);
    }
}

}
