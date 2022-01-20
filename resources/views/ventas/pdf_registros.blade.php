<style>
body{
  margin: 0;
}
#datos {border:2px solid; width:50%; text-align:center}
#datos tr {border:2px solid;}
#datos tr td{border:2px solid;}
</style>

<?php
$arrayMeses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
              'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
     $arrayDias = array( 'Domingo', 'Lunes', 'Martes',
                 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
   ?>


<hr style="height:1px; border:none; color:#000; background-color:#000; width:100%; text-align:left; margin: 0 auto 0 0;">

<br />
<br />  <br />

<div class="table">
  <table align="center"class="table table-bordered table-info" border="1" style="font-size:18px; font-family: 'Century Gothic'; border:2px solid #819FF7; max-width: auto;">
  <thead>
    <tr>
	    <th style="width:auto; font-size: 12px;">Fecha</th>
        <th style="width:auto; font-size: 12px;">Producto</th>
        <th style="width:200px; font-size: 11px;">Cantidad Vendida</th>
        <th colspan="1" style="width:auto; font-size: 10px;" >Total</th>
        <th style="width:40px; font-size: 11px;">Precio publico</th>
        <th style="width:150px; font-size: 12px;">Precio Venta</th>
        <th style="width:150px; font-size: 12px;">Ganancia</th>
    </tr>
  </thead>
  <tbody>
  @foreach($dato as $datos)
      <tr>
	    <th style="width:auto; font-size: 12px;" scope="row">{{$datos->created_at }}</th>
        <th style="width:auto; font-size: 12px;" scope="row">{{$datos->produto }}</th>
        <td style="width:250px; font-size: 11px;">{{$datos->cantidad_vendida }}</td>
        <td style="width:auto; font-size: 12px;" >$ {{$datos->total }}</td>
        <td style="width:40px; font-size: 11px;">$ {{$datos->precio_pub }} </td>
        <td style="width:80px; font-size: 12px;">$ {{$datos->precio_may }}</td>
          <td style="width:80px; font-size: 12px;"> {{$datos->ganancias }} </td>

           </tr>
             @endforeach
    </tbody>
  </table>
</div>
