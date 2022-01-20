<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/download/{file}', 'HomeController@download');
Route::get('/', function ()
{return view('des');}
);

//Route::get('/', 'HomeController@inicio')->name('inicio_sesion');
Route::group(['middleware' => 'auth'], function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::get('registrar', 'HomeController@registrar')->name('registrar_usuario');
Route::post('registro_users', 'HomeController@create_users')->name('registro_users');
Route::get('usuarios_activos', 'HomeController@users_act')->name('usuarios_activos');
Route::get('users', 'HomeController@usuarios')->name('users');
Route::get('denegado', 'HomeController@acceso_denegado')->name('denegado');
//Rutas Frutas y Verduras
Route::get('frutas', 'ProductoController@frutas')->name('frutas');
Route::get('products', 'ProductoController@agregar_producto')->name('products');
Route::post('registro_producto', 'ProductoController@create_producto')->name('registro_producto');
Route::post('actualizarfruta', 'ProductoController@actualizarfruta')->name('actualizarfruta');
Route::post('actualizarpreciofruta', 'ProductoController@actualizarpreciof')->name('actualizarpreciofruta');
Route::post('agregar_stock_fruta', 'ProductoController@agregar_stock_f')->name('agregar_stock_fruta');
Route::post('quitar_stock_fruta', 'ProductoController@quitar_stock_f')->name('quitar_stock_fruta');
Route::get('dataproductstables','ProductoController@getValores')->name('dataproductstables');
Route::get('datospr/{id}', 'ProductoController@getDatosPr');
Route::post('producto_edit','ProductoController@getedicionproductos')->name('producto_edit');
Route::get('prodesac/{id}', 'ProductoController@desac');
Route::get('disabled', 'ProductoController@ver_desactivados')->name('disabled');
Route::get('dataproductstablesdes','ProductoController@getValoresactivos')->name('dataproductstablesdes');
Route::get('prodac/{id}', 'ProductoController@acnew');
Route::get('warning', 'ProductoController@otras_acciones')->name('warning');
Route::get('promociones', 'ProductoController@prod_prom')->name('promociones');
//Rutas Carnes y Lacteos
Route::get('carnes', 'CarnesController@carneslac')->name('carnes');
Route::post('actualizarcarne', 'CarnesController@actualizarcarne')->name('actualizarcarne');
Route::post('actualizarpreciocarne', 'CarnesController@actualizarpreciocl')->name('actualizarpreciocarne');
Route::post('agregar_stock_carne', 'CarnesController@agregar_stock_cl')->name('agregar_stock_carne');
Route::post('quitar_stock_carne', 'CarnesController@quitar_stock_cl')->name('quitar_stock_carne');
//Rutas Semillas y Otros
Route::get('semillas', 'SemillasController@semillaot')->name('semillas');
Route::post('actualizarsemilla', 'SemillasController@actualizarsemilla')->name('actualizarsemilla');
Route::post('actualizarpreciosemilla', 'SemillasController@actualizarprecioso')->name('actualizarpreciosemilla');
Route::post('agregar_stock_semilla', 'SemillasController@agregar_stock_so')->name('agregar_stock_semilla');
Route::post('quitar_stock_semilla', 'SemillasController@quitar_stock_so')->name('quitar_stock_semilla');
//Rutas VentasController
Route::get('ventas', 'VentasController@ventas_inicio')->name('ventas');
Route::get('datauserstables','HomeController@getValores')->name('datauserstables');
Route::post('datosaeditar','HomeController@getedicionusuarios')->name('datosaeditar');
Route::get('datauserstables','HomeController@getValores')->name('datauserstables');
Route::get('quitar_act/{id}', 'HomeController@productos_insert');
Route::get('revisarSt/{id}', 'HomeController@revstock');
Route::get('datopro/{id}', 'VentasController@revpro');
Route::get('ventas_del_dia','VentasController@getventastoday')->name('ventas_del_dia');
//Route::get('datauserstables', array('as' => 'datauserstables', 'uses' => 'HomeController@getValores'));
Route::post('realizarventa', 'VentasController@datosenviados')->name('realizarventa');
Route::get('registros','VentasController@ventas_registros')->name('registros');
Route::get('dataregventas','VentasController@getReger')->name('dataregventas');
Route::get('ventasmias','VentasController@getmisventas')->name('ventasmias');
Route::get('registros_especificos','VentasController@registros_espec')->name('registros_especificos');
Route::get('busqueda_especifica/{fecha}/{tipo_bus}', 'VentasController@busqueda_realizada_prueba');
Route::post('addstock','ProductoController@setaddstock')->name('addstock');
Route::get('dataproductstablesquitar','ProductoController@getValoresquitar')->name('dataproductstablesquitar');
Route::post('quitstock','ProductoController@setquitstock')->name('quitstock');
Route::get('registros_eventos','ProductoController@visor_eventos')->name('registros_eventos');
Route::get('dataeventstables','ProductoController@getevents')->name('dataeventstables');
Route::get('cuenta', 'HomeController@password')->name('cuenta');
Route::post('changePassword','HomeController@changePassword')->name('changePassword');
Route::get('descargas', function(){
return Excel::download(new UsersExport, 'users.xlsx');
});
Route::get('descarga_users', 'DownloadController@downus');
Route::get('pdf_registros/{fecha}/{tipo}','DownloadController@descarga_datos');
Route::get('homestore','InterfazController@vista_new')->name('homestore');
Route::get('ventas_extraoficial', 'VentasController@ventas_extra')->name('ventas_extraoficial');
Route::get('venta_nueva', 'VentasController@ventas_pro')->name('venta_nueva');
Route::get('dataproductstables_pro','ProductoController@prod_prom_data')->name('dataproductstables_pro');
Route::post('addpromos','ProductoController@setaddpromo')->name('addpromos');
});

Auth::routes(['verify' => true]);

Auth::routes();
