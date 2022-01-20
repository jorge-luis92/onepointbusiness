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

class InterfazController extends Controller
{
    public function vista_new(){

      $frutas = DB::table('products')
      ->select('products.id','products.nombre', 'products.precio', 'products.unidad', 'products.tipo', 'products.stock')
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

      return view('prueba', ['producto' => $frutas, 'pago' => $users, 'ganacias_dia' => $ganas]);
    }
}
