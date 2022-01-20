@extends('layouts.newmode')
@section('title')
: Generar venta
@endsection
@section('content')
<div class="container">
     @include('flash-message')
     <div id='alrt' style="fontWeight = 'bold'"></div>
     <div class="row justify-content-center">
         <div class="col-md-12">
             <div class="card" style="background-color: #FEF9E7;">

               <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" >
                   <div class="container" >
                       <a class="navbar-brand">
                           Nueva venta
                       </a>
                       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#frutals" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                           <span class="navbar-toggler-icon"></span>
                       </button>

                       <div class="collapse navbar-collapse" id="frutals">
                         <ul class="nav nav-tabs" id="myTab" role="tablist">


                           <li class="nav-item" role="presentation">
                             <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inicio</a>
                           </li>
<!--
                           <li class="nav-item" role="presentation">
                             <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Ventas del día</a>
                           </li>
    -->                       <li class="nav-item" role="presentation">
   <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Productos</a>
 </li>


                             </ul>
                       </div>
                   </div>
               </nav>

               <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
              </br>
              <div class="form-group row">
                  <label for="producto" class="col-md-4 col-form-label text-md-right">{{ __('Seleccione el producto') }}</label>
                  <div class="col-md-6">
                      <select name="tipo" id="tipo" required class="form-control" >
                        @foreach( $producto as $tipo)
         <option id="tipo" value="{{$tipo->id}}">{{ $tipo->nombre}} ----> Precio: $ {{ $tipo->precio}} ----> Disponible: {{$tipo->stock}} {{$tipo->unidad_venta}}</option>
        @endforeach
                    </select>
                  </br>
                    <span >
              <!--    <button id="agregar_productos"  class="btn btn-danger" >-->
                      <button id="btngramoss"  class="btn btn-danger" >
                        <span>
                    <i class="fa fa-" >Cantidad</i></span>
                       </button>

                    </span>
                    <span>
              <!--    <button id="agregar_productos"  class="btn btn-danger" >-->
                      <button id="btnpesos"  class="btn btn-danger" >
                        <span>
                    <i class="fa fa-" >Pesos</i></span>
                       </button>

                    </span>
            </div>
          </div>
                      <div class="table-responsive">
  <table id="tabla-materiales" class="table table-bordered table-striped" style="color: #000000;" >
    <thead>
      <tr>
        <th scope="col" readonly>ID</th>
          <th scope="col">Nombre</th>
         <th scope="col">Precio</th>
          <th scope="col">Cantidad</th>
          <th scope="col">Total</th>
          <th scope="col">Quitar</th>
      </tr>
    </thead>
    <tbody id="productos_insertados">

  </tbody>
</table>
</div>
<div class="modal-footer">

  <label >Total de Venta: $ </label>   <label id="totalV"></label>
    <input  hidden name="id_producs" id="id_producs" value="">
</div>
<div class="modal-footer">

    <button type="submit" id="ejecutarVenta" class="btn btn-dark">Vender</button>
</div>

<div class="modal fade" id="gramosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formGram">
           @csrf
            <div class="modal-body">

    <div class="form-group row">
        <label for="cantidad_gram" class="col-md-3 col-form-label text-md-right">{{ __('Ingrese cantidad: ') }}</label>

        <div class="col-md-4">
            <input id="cantidad_gram" placeholder="Gramos, piezas, etc." type="tel" maxlength="5" onkeypress="return numeros (event)"  class="form-control @error('cantidad_gram') is-invalid @enderror" name="cantidad_gram" value="{{ old('cantidad_gram') }}" required >

            @error('cantidad_gram')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
<label for="sds" class="col-md-2 col-form-label text-md-right"><input type="checkbox" id="cbox1" name="cbox1"> Descuento</label>


    </div>

    <input hidden name="id_produc" id="id_produc">
    <div class="modal-footer">
        <button type="button" class="btn btn-light btnBorrars" data-dismiss="modal">Cancelar</button>
        <button type="submit" id="btn_add" class="btn btn-dark">Agregar</button>
    </div>
          </form>

<!-- final modal-->
</div>
</div>
</div>
</div>

<div class="modal fade" id="pesosa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPesos">
           @csrf
            <div class="modal-body">

    <div class="form-group row">
        <label for="cantidad_pes" class="col-md-4 col-form-label text-md-right">{{ __('Ingrese pesos: ') }}</label>

        <div class="col-md-3">
            <input id="cantidad_pes" placeholder="$" type="tel" maxlength="5" onkeypress="return numeros (event)"  class="form-control @error('cantidad_pes') is-invalid @enderror" name="cantidad_pes" value="{{ old('cantidad_pes') }}" required autocomplete="cantidad_pes" autofocus>

            @error('cantidad_pes')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <label for="ss" class="col-md-3 col-form-label text-md-right"><input type="checkbox" id="cbox2" value="second_checkbox"> Descuento</label><br>
    </div>

    <input hidden name="id_produc" id="id_produc">
    <div class="modal-footer">
        <button type="button" class="btn btn-light btnBorrars" data-dismiss="modal">Cancelar</button>
        <button type="submit" id="btn_add" class="btn btn-dark">Agregar</button>
    </div>
          </form>

<!-- final modal-->
</div>
</div>
</div>
</div>

</div><!-- termina el primero-->


  <!-- termina el segundo-->
<!--

-->
               <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                 <div class="table-responsive">
     <table class="table table-bordered table-striped" style="color: #000000;" id="productos_table_todos">
       <thead>
         <tr>
             <th scope="col">Nombre</th>
             <th scope="col" >Unidad de Venta</th>
             <th scope="col">Tipo</th>
              <th scope="col" >Precio</th>
              <th scope="col" >Disponible para Vender</th>
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
   <script type="text/javascript" src="js/ventas_pro.js"></script>

   @endsection
