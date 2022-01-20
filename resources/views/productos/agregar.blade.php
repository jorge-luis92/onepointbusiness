@extends('layouts.newmode')
@section('title')
: Productos
@endsection
@section('content')
<div class="container">
     @include('flash-message')
     <div class="row justify-content-center">
         <div class="col-md-12">
             <div class="card">
               <div class="form-group row">
               <div class="col-md-4">
                 <button type="button" class="btn btn-outline-primary btn-sm btnNuevoP" data-toggle="tooltip" title="Nuevo">Nuevo Producto
                   <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
<path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
</svg>
                       </button>
               </div>
             </div>

               <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                   <div class="table-responsive">
       <table class="table table-bordered table-striped" style="color: #000000; " id="productos_table">
         <thead>
           <tr>
             <th scope="col" >ID</th>
               <th scope="col">Nombre</th>
               <th scope="col">Tipo</th>
              <th scope="col">Precio Público</th>
              <th scope="col">Disponible</th>
              <th scope="col">Inversión</th>
              <th scope="col">Producto</th>
              <th scope="col">Stock</th>
           </tr>
         </thead>
         <tbody>

       </tbody>
     </table>
   </div>
   <div class="modal fade" id="modalprodedit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <form id="editpr">
                   @csrf
                   <div class="form-group row">
                       <label for="nombrep" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                       <div class="col-md-6">
                           <input id="nombrep" type="text" class="form-control @error('nombrep') is-invalid @enderror" name="nombrep" value="" required autocomplete="nombrep" autofocus>

                           @error('nombrep')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="tipop" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de producto') }}</label>

                       <div class="col-md-6">

                           <select name="tipop" id="tipop" required class="form-control"  >
                         <option >Seleccione opción</option>
                         <   <option value="Fruta">Fruta</option>
                            <option value="Verdura">Verdura</option>
                            <option value="Carne">Carne</option>
                            <option value="Semillas">Semillas</option>
                            <option value="Lacteo">Lacteos</option>
                            <option value="Dulce">Dulces</option>
                            <option value="Otro">Otro</option>
                   </select>
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="precio_mayp" class="col-md-4 col-form-label text-md-right">{{ __('Precio Compra') }}</label>

                       <div class="col-md-6">
                           <input id="precio_mayp" type="tel" maxlength="5" onkeypress="return numeros (event)" class="form-control @error('precio_mayp') is-invalid @enderror" name="precio_mayp" value="" required autocomplete="precio_may">

                           @error('precio_mayp')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="preciop" class="col-md-4 col-form-label text-md-right">{{ __('Precio público') }}</label>

                       <div class="col-md-6">
                           <input id="preciop" type="tel" maxlength="5" onkeypress="return numeros (event)" class="form-control @error('preciop') is-invalid @enderror" name="preciop" value="" required autocomplete="preciop" autofocus>

                           @error('preciop')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="unidadp" class="col-md-4 col-form-label text-md-right">{{ __('Unidad Compra') }}</label>

                       <div class="col-md-6">

                           <select name="unidadp" id="unidadp" required class="form-control" autocomplete="unidadp" >
                         <option >Seleccione opción</option>
                         <option value="KG">Kilogramo</option>
                         <option value="Pieza">Pieza</option>
                         <option value="Manojo">Manojo</option>
                         <option value="Bolsa">Bolsa</option>
                         <option value="Otro">Otro</option>
                   </select>
                       </div>
                   </div>

                   <div class="form-group row">
                       <label for="unidad_ventap" class="col-md-4 col-form-label text-md-right">{{ __('Unidad de Venta') }}</label>

                       <div class="col-md-6">

                           <select name="unidad_ventap" id="unidad_ventap" required class="form-control" autocomplete="unidad_ventap" >
                         <option >Seleccione opción</option>
                         <option value="Gramos">Gramos</option>
                         <option value="Pieza">Pieza</option>
                         <option value="Manojo">Manojo</option>
                         <option value="Bolsa">Bolsa</option>
                         <option value="Otro">Otro</option>
                   </select>
                       </div>
                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-light btnBorrar" data-dismiss="modal">Cancelar</button>
                       <button type="submit" id="btnActp" class="btn btn-dark">Actualizar</button>
                   </div>
                 </br>
               </form>
           </div>
       </div>
   </div>
                 </div>

                 <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                   <div class="table-responsive">
       <table class="table table-bordered table-striped" style="color: #000000;" id="productos_table_quitar">
         <thead>
           <tr>
             <th scope="col" >ID</th>
               <th scope="col">Nombre</th>
              <th scope="col">Disponible para venta</th>
              <th scope="col">Acción</th>
              <th scope="col">Stock</th>
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
   </div>
   <div class="modal fade" id="modalNuevoProd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Alta de Producto</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                   </button>
               </div>
           <form id="formProN">
              @csrf
              <div class="form-group row">
                  <label for="nombre" class="col-md-4 col-form-label text-md-right" autofocus>{{ __('Nombre') }}</label>

                  <div class="col-md-6">
                      <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus>

                      @error('nombre')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label for="tipo" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de producto') }}</label>

                  <div class="col-md-6">

                      <select name="tipo" id="tipo" required class="form-control" autocomplete="tipo" >
                    <option value="">Seleccione una opción</option>
                    <option value="Fruta">Fruta</option>
                    <option value="Verdura">Verdura</option>
                    <option value="Carne">Carne</option>
                    <option value="Semillas">Semillas</option>
                    <option value="Lacteo">Lacteos</option>
                    <option value="Dulce">Dulces</option>
                    <option value="Otro">Otro</option>
              </select>
                  </div>
              </div>
              <div class="form-group row">
                  <label for="precio_may" class="col-md-4 col-form-label text-md-right">{{ __('Precio Compra') }}</label>

                  <div class="col-md-6">
                      <input id="precio_may" type="tel" maxlength="5" onkeypress="return numeros (event)" class="form-control @error('precio_may') is-invalid @enderror" name="precio_may" required autocomplete="precio_may">

                      @error('precio_may')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>
              <div class="form-group row">
                  <label for="precio" class="col-md-4 col-form-label text-md-right">{{ __('Precio público') }}</label>

                  <div class="col-md-6">
                      <input id="precio" type="tel" maxlength="5" onkeypress="return numeros (event)" class="form-control @error('precio') is-invalid @enderror" name="precio" value="{{ old('precio') }}" required autocomplete="precio" autofocus>

                      @error('precio')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
              </div>

              <div class="form-group row">
                  <label for="unidad" class="col-md-4 col-form-label text-md-right">{{ __('Unidad compra') }}</label>

                  <div class="col-md-6">

                      <select name="unidad" id="unidad" required class="form-control" autocomplete="unidad" >
                    <option value="">Seleccione una opción</option>
                    <option value="KG">Kilogramo</option>
                    <option value="Pieza">Pieza</option>
                    <option value="Manojo">Manojo</option>
                    <option value="Bolsa">Bolsa</option>
                    <option value="Otro">Otro</option>
              </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="unidad_venta" class="col-md-4 col-form-label text-md-right">{{ __('Unidad de Venta') }}</label>

                  <div class="col-md-6">

                      <select name="unidad_venta" id="unidad_venta" required class="form-control" autocomplete="unidad_venta" >
                    <option value="">Seleccione una opción</option>
                    <option value="Gramos">Gramos</option>
                    <option value="Pieza">Pieza</option>
                    <option value="Manojo">Manojo</option>
                    <option value="Bolsa">Bolsa</option>
                    <option value="Otro">Otro</option>
              </select>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light btnCancel" data-dismiss="modal">Cancelar</button>
                  <button type="submit" id="btnRegPro" class="btn btn-dark">Registrar Producto</button>
              </div>
   </form>

   <!-- final modal-->
   </div>
   </div>
   </div>

   <div id="modalStock" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar a Stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="postStock">
              @csrf
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" disabled id="recipient-name" value="">
            </div>

      <input hidden="hidden" name="id" id="id" value="">
           <div class="form-group">
              <label for="recipient-name" class="col-form-label">Inserte cantidad a agregar:</label>
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


   </div>
   @endsection

   @section('scru')
    <script src="{{ asset('js/jquery-1.10.2.js') }}" ></script>
   <script src="{{ asset('js/jquery-ui.js') }}" ></script>
   <script src="{{ asset('js/bootstrap.min.js')}}" ></script>
   <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="jquery/jquery-3.3.1.min.js"></script>
   <script src="popper/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>

   <!-- datatables JS -->
   <script type="text/javascript" src="datatables/datatables.min.js"></script>
   <script type="text/javascript" src="{{ asset('js/productoss.js')}}"></script>

   @endsection
