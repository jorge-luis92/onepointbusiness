@extends('layouts.newmode')
@section('title')
: Registros generales
@endsection
@section('content')
<div class="container">
     @include('flash-message')
     <div class="row justify-content-center">

         <div class="col-md-12">
           <a style="size: 1.0;"> <strong>Total de ventas: $ {{$pago}} &nbsp;&nbsp;&nbsp;&nbsp;</strong> <strong>Ganancias: $ {{$ganacias_dia}} </strong>
           </br></a>

             <div class="card">

                <div class="tab-content">

                                  <div class="table-responsive">

                                    <table class="table table-bordered table-striped" style="color: #000000;" id="registro_ventas_dia">
                                      <thead>
                                        <tr>
                                           <th scope="col">Fecha Venta</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad vendida</th>
                                            <th scope="col">Total Venta</th>
                                            <th scope="col">Precio Público</th>
                                            <th scope="col">Precio Compra</th>
                                          <th scope="col">Ganancia</th>

                                        </tr>
                                      </thead>
                                    <tbody>

 </tbody>
 </table>
 </div>
                            </div>
                     </div>
                </div>
  </div>
</div>


   @endsection
   @section('scru')
    <script src="{{ asset('js/jquery-1.10.2.js') }}" ></script>
   <script src="{{ asset('js/jquery-ui.js') }}" ></script>
   <script src="{{ asset('js/bootstrap.min.js')}}" ></script>
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="{{ asset('jquery/jquery-3.3.1.min.js')}}"></script>
   <script src="{{ asset('popper/popper.min.js')}}"></script>
   <script src="{{ asset('js/bootstrap.min.js')}}"></script>

   <!-- datatables JS -->
   <script type="text/javascript" src="datatables/datatables.min.js"></script>
   <script type="text/javascript" src="js/ventas.js"></script>

   @endsection
