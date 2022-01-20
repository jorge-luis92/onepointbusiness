<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Detailsale;
use App\Models\Sale;
use Log;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
//use DataTables;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

  //    return view('home')->with('success','¡Inicio de sesión correctamente!');  $usuario_actual->type=='Administrador' ||
      //  return redirect()->route('home')->with('success','¡Inicio de sesión correctamente!');

      $usuario_actual=\Auth::user();
       if( $usuario_actual->type=='Denegado'){
         Auth::logout();
       return redirect('denegado')->with('error','Acceso Denegado');
        }
        return view('/homes');
    //    return redirect()->route('home')->with('success','¡Inicio de sesión correctamente!');
    }

    public function registrar()
    {
        return view('users.register');
    }

    public function create_users(Request $request)
  {

    $validator = Validator::make($request->all(), [
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
          ]);


          if ($validator->passes()) {
            $data = $request;
              User::create([
                  'name' => $data['name'],
                  'email' => $data['email'],
                  'password' => Hash::make($data['password']),
                  'type' => $data['type'],
              ]);
  			return response()->json(['success'=>'Usuario registrado correctamente.']);
          }

        //  	return response()->json(['error'=>'rSFDDS.']);
        	return response()->json(['error'=>$validator->errors()->all()]);

  //return redirect()->route('users')->with('success','¡Datos registrados correctamente!');
  }

  public function users_act(){

    //$users = DB::table('users')
    //->get();
$users = App\User::first();

            return view('users.activos', ['users' => $users]);


  }
  public function usuarios(){

//$users = DB::table('users')->get();
  //  ->orderBy('users.name', 'asc')
    //->simplePaginate(8);
    $usuario_actual=\Auth::user();
     if($usuario_actual->type=='Vendedor'){

     return redirect('/home')->with('error','Acceso Denegado -- Solo Administradores del sistema pueden ingresar');
      }

return view('users.users');
//return view('users.users', ['users' => $users]);

}

public function download($file_name) {
      $file_path = public_path('files/'.$file_name);
      return response()->download($file_path);
    }

public function getValores(){
  //return Datatables::of(User::query())->make(true);
  return Datatables::of(User::select('id','name', 'email', 'type'))
  ->toJson();

}

public function getedicionusuarios(Request $request){

$data =$request;
$id =$data['id'];
$name =$data['user'];
$tipo = $data['type'];

if($tipo== 'Administrador' || $tipo== 'Vendedor' || $tipo== 'Super Admin'){

  $affected = DB::table('users')
                ->where('id', $id)
                ->update(['name' => $name, 'type' => $tipo]);
}
              return 'No creooooo';
}

public function desactivar_act($req){
  $valor=$req;

  $consulta = DB::table('users')
     ->select('users.id', 'users.name', 'users.email')
     ->where('users.id', $valor)
     ->take(1)
     ->first();

return json_encode ($consulta);

}


public function productos_insert($req){
  $valor=$req;

  $consulta = DB::table('products')
     ->select('products.id', 'products.nombre', 'products.promocion', 'products.tipo', 'products.unidad', 'products.precio', 'products.unidad_venta', 'precio_may')
     ->where('products.id', $valor)
     ->take(1)
     ->first();

return json_encode ($consulta);

}


public function revstock($req){
  $valor=$req;

  $consulta = DB::table('products')
     ->select('products.stock')
     ->where('products.id', $valor)
     ->take(1)
     ->first();

return json_encode ($consulta);

}


    public function password(){

    return view('users.configuracion_cuenta');
    }

    public function changePassword(Request $request){

      if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
          // The passwords matches
          return redirect()->back()->with("error","Su contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.");
      }

      if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
          //Current password and new password are same
          return redirect()->back()->with("error","La nueva contraseña no puede ser la misma que su contraseña actual. Por favor, elija una contraseña diferente.");
      }

      $validatedData = $request->validate([
          'current-password' => 'required',
          'new-password' => 'required|string|min:8|confirmed',
      ]);

      //Change Password
      $user = Auth::user();
      $user->password = bcrypt($request->get('new-password'));
      $user->save();

      if($user->save()){
      //  $this->auth()->logout();
      Auth::logout();
      //  $request->session()->invalidate();

     return redirect('login')->with('success','Contraseña Actualizada Correctamente, Inicie sesión nuevamente');
      //  return redirect()->route('cuenta')->with('success','Contraseña Actualizada Correctamente');
      }

  }

  protected function acceso_denegado(){

    return view('users.acceso_denegado');
  }

}
