@extends('layouts.app')

@section('content')
<div class="container">
     @include('flash-message')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">

                        <a class="navbar-brand">
                            Frutas y Verduras
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#frutals" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="frutals">
                          <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inicio</a>
                            </li>

                            <li class="nav-item" role="presentation">
                              <a class="nav-link" id="messages-tab" data-toggle="tab" href="#messages" role="tab" aria-controls="messages" aria-selected="false">Stock</a>
                            </li>
                            <li class="nav-item" role="presentation">
    <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Estadisticas</a>
  </li>
                                              </ul>
                                              </div>
                </nav>
              </br>
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="table-responsive">


      <table class="table table-bordered table-striped" style="color: #000000;" id="frutas_todas" >
        <thead>
          <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Precio actual</th>
            <th  scope="col" style="text-align: center;">Editar</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($fruta as $producto)
        <tr>
               <th scope="row">{!! $producto->nombre !!}</th>
               <th scope="row">$ {!! $producto->precio !!} {!! $producto->unidad !!}</th>
               <td style="text-align: center;">  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarprecio{{$producto->id}}">Precio</button>
               <div id="editarprecio{{$producto->id}}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                 <div class="modal-dialog modal-dialog-centered">
                   <div class="modal-content">

                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel">Editar Precio</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <form method="POST" action="{{ route('actualizarpreciofruta') }}">
                           @csrf
                         <div class="form-group row">
                            <input hidden name="id" id="id" value="{{ $producto->id}}">
                           <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>
                           <div class="col-md-6">
                           <input type="text" class="form-control" disabled id="recipient-name" value="{{$producto->nombre}}">
                         </div>
                       </div>

                             <div class="form-group row">
                              <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Precio') }}</label>
                              <div class="col-md-6">

                           <input type="tel" name="precio" class="form-control" maxlength="5" onkeypress="return numeros (event)"  id="precio" value="{{$producto->precio}}">
                         </div>
                       </div>

                         <button type="submit" class="btn btn-primary">
                             {{ __('Actualizar Precio') }}
                         </button>

                       </form>
                     </div>
                     <div class="modal-footer">

                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                     </div>

                   </div>
                 </div>
               </div>
               </td>
               </tr>
         @endforeach
      </tbody>
    </table>
  </div>

                  </div>



<div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">
  <div class="table-responsive">


<table class="table table-bordered table-striped" style="color: #000000;" id="frutas_stock">
<thead>
<tr>
<th scope="col">Nombre</th>
<th scope="col">Disponible</th>
<th  scope="col" style="text-align: left;">Agregar</th>
<th  scope="col" style="text-align: left;">Quitar</th>
</tr>
</thead>
<tbody>
@foreach ($fruta as $producto)
<tr>
<th scope="row">{!! $producto->nombre !!}</th>
<th scope="row">{!! $producto->stock !!} {!! $producto->unidad_venta !!} </th>
<td>  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarstock{{$producto->id}}">Agregar</button>
<div id="editarstock{{$producto->id}}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-dialog-centered">
   <div class="modal-content">

     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Agregar a Stock</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <form method="POST" action="{{ route('agregar_stock_fruta') }}">
           @csrf
         <div class="form-group">
           <label for="recipient-name" class="col-form-label">Nombre:</label>
           <input type="text" class="form-control" disabled id="recipient-name" value="{{$producto->nombre}}">
         </div>

   <input hidden="hidden" name="id" id="id" value="{{ $producto->id}}">
        <div class="form-group">
           <label for="recipient-name" class="col-form-label"> {{$producto->unidad}} disponible para venta: {{$producto->stock}} </label>
           <input type="tel" name="stock" class="form-control" maxlength="5" onkeypress="return numeros (event)"  id="stock" required>
               </div>
               <button type="submit" class="btn btn-primary">
                   {{ __('Actualizar') }}
               </button>
       </form>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

     </div>

   </div>
 </div>
</div>
</td>
<td>
  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editarstock_q{{$producto->id}}">Quitar</button>
  <div id="editarstock_q{{$producto->id}}" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
     <div class="modal-content">

       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Quitar del Stock</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         <form method="POST" action="{{ route('quitar_stock_fruta') }}">
             @csrf
           <div class="form-group">
             <label for="recipient-name" class="col-form-label">Nombre:</label>
             <input type="text" class="form-control" disabled id="recipient-name" value="{{$producto->nombre}}">
           </div>

     <input hidden="hidden" name="id" id="id" value="{{ $producto->id}}">
          <div class="form-group">
             <label for="recipient-name" class="col-form-label"> {{$producto->unidad}} disponible para venta: {{$producto->stock}} </label>
             <input type="tel" name="stock" class="form-control" maxlength="5" onkeypress="return numeros (event)"  id="stock" required>
                 </div>
                 <button type="submit" class="btn btn-primary">
                     {{ __('Actualizar') }}
                 </button>
         </form>
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

       </div>

     </div>
   </div>
  </div>
</td>

         </tr>
@endforeach
</tbody>
</table>
</div>

        </div>
        <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

prueba Estadisticas
        </div>
    </div>

</div>
</div>


@endsection
