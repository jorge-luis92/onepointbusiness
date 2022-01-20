<html>
<head>
  <link href="{{ env('APP_URL') }}/css/nuevo.css" rel="stylesheet">
  <style>
    body{
      font-family: sans-serif;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      top: -160px;
      right: 0px;
      height: 50px;
      background-color: #ddd;
      text-align: center;
    }
    header h1{
      margin: 5px 0;
    }
    header h2{
      margin: 0 0 10px 0;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }

table, th, td {
  border: 1px solid black;
}
  </style>
<body>
  <header>
    <h1>Reporte de registros - {{$tipo}}</h1>
  </header>
  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
              Fruits and Vegetables
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <div id="content">
    <div class="content">
      <p> Corte del día: $ {{$total}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Ganancias: $ {{$ganancia}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Inversión: {{$total-$ganancia}}</p>
      <table>
      <thead>
        <tr>
    	    <th style="width:130px; font-size: 12px; text-align: left;">Fecha</th>
            <th style="width:120px; font-size: 12px; text-align: left;" >Producto</th>
            <th style="width:120px; font-size: 12px; text-align: left;" >Cantidad Vendida</th>
            <th style="width:70px; font-size: 12px; text-align: left;" >Total</th>
            <th style="width:90px; font-size: 12px; text-align: left;">Precio publico</th>
            <th style="width:90px; font-size: 12px; text-align: left;">Precio Compra</th>
            <th style="width:auto; font-size: 12px; text-align: left;">Ganancia</th>
        </tr>
      </thead>
      <tbody>
      @foreach($dato as $datos)
          <tr>
    	    <td style="width:auto; font-size: 12px;">{{ date('d-m-Y h:i A', strtotime($datos->created_at)) }}</th>
            <td style="width:auto; font-size: 12px;">{{$datos->produto }}</th>
            <td style="width:auto; font-size: 12px;">{{$datos->cantidad_vendida }} {{$datos->unidad_venta}}</td>
            <td style="width:auto; font-size: 12px;">$ {{$datos->total }}</td>
            <td style="width:auto; font-size: 12px;">$ {{$datos->precio_pub }} </td>
            <td style="width:auto; font-size: 12px;">$ {{$datos->precio_may }}</td>
              <td style="width:auto; font-size: 12px;">$ {{$datos->ganancias }} </td>
               </tr>
                 @endforeach
        </tbody>
      </table>
    </div>

  </div>
</body>
</html>
