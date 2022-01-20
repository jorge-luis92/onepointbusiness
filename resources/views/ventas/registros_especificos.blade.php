@extends('layouts.newmode')
@section('title')
: Registros especificos
@endsection
@section('content')
<div class="container">
     @include('flash-message')
     <div class="row justify-content-center">

         <div class="col-md-12">
           <a style="size: 1.0;">
             <strong>Total de ventas: $ <label id="total_especifico" name="total_especifico"> </label> </strong>
              <strong>Ganancias: $ <label id="ganancia_especifico" name="ganancia_especifico"> </label> </strong></a>
</br>
<form id="busqueda_registros_especificos">
  <div class="form-group row">
                <strong>  <label for="name" class="col-md-12 col-form-label text-md-right">{{ __('Seleccione una fecha') }}</label> </strong>

                  <div class="col-md-3">
                    <input id="fecha_inicio" type="date"  max=""  value="" class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio" required>
              </div>

              <div class="col-md-3">
                <select name="tipo_busqueda_pr" id="tipo_busqueda_pr" required class="form-control">
             <option value="">Seleccione una opción</option>
             <option value="General">General</option>
             <option value="Fruta">Frutas y Verduras</option>
              <option value="Carne">Carne</option>
              <option value="Semillas">Semillas</option>
              <option value="Lacteo">Lacteos</option>
              <option value="Dulce">Dulces</option>
              <option value="Otro">Otro</option>
        </select>
              </div>
<button id="primerarespuesta"  class="btn btn-danger" >
                <span>
            <i class="fa fa-search" > Buscar</i></span>
          </button>
&nbsp;
&nbsp;

              </div>



</form>
<form id="download_pdf_reg">

  <button id="primerarespuesta"  class="btn btn-danger" >
            <span>
        <i class="fa fa-download" > Descargar PDF</i></span>
      </button>
</form>
            </br>
             <div class="card">
                <div class="tab-content">

                                  <div class="table-responsive">

                                    <table class="table table-bordered table-striped" style="color: #000000;" id="registro_ventas_especificas">
                                      <thead>
                                        <tr>
                                           <th scope="col">Fecha Venta</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad vendida</th>
                                            <th scope="col">Total Venta</th>
                                             <th scope="col">Precio Público</th>
                                             <th scope="col">Precio Compra</th>
                                             <th scope="col">Ganancias</th>
                                        </tr>
                                      </thead>
                                    <tbody id="reg_esp_fecha">

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
