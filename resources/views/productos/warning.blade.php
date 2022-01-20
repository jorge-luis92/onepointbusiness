@extends('layouts.newmode')
@section('title')
: warning
@endsection
@section('content')
<div class="container">
     @include('flash-message')
     <div class="row justify-content-center">
         <div class="col-md-12">
             <div class="card">
               <div class="form-group row">
               <div class="col-md-4">

               </div>
             </div>
               <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
   <div id="modalStockQuit" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Quitar del Stock</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="postStockQuit">
              @csrf
            <div class="form-group">
              <label for="recipient-name-res" class="col-form-label">Nombre:</label>
              <input type="text" class="form-control" disabled id="recipient-name-res" value="">
            </div>

      <input name="id_quitar" hidden="hidden" id="id_quitar" value="">
           <div class="form-group">
              <label for="stock_quit" class="col-form-label"> Ingrese cantidad a retirar</label>
              <input type="tel" name="stock_quit" class="form-control" maxlength="5" onkeypress="return numeros (event)"  id="stock_quit" required>
                  </div>
                  <div class="form-group">
                     <label for="motivo" class="col-form-label"> Motivo del retiro: </label>
                     <textarea name="motivo" id="motivo" class="form-control" rows="2"required></textarea>
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

                 </div>

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
   <script src="jquery/jquery-3.3.1.min.js"></script>
   <script src="popper/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>

   <!-- datatables JS -->
   <script type="text/javascript" src="datatables/datatables.min.js"></script>
   <script type="text/javascript" src="{{ asset('js/productoss.js')}}"></script>

   @endsection
