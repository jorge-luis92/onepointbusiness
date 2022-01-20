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
               <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
                   <div class="table-responsive">
       <table class="table table-bordered table-striped" style="color: #000000; " id="productos_table_promos">
         <thead>
           <tr>
             <th scope="col" >ID</th>
               <th scope="col">Nombre</th>
              <th scope="col">$ Precio venta</th>
              <th scope="col">$ Promoción</th>
              <th scope="col">Acción</th>
           </tr>
         </thead>
         <tbody>
       </tbody>
     </table>

     <div id="modalpromo" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Promoción de producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="postpromo">
                @csrf


        <input hidden="hidden" name="id" id="id" value="">
          <input hidden="hidden" name="recipient-name" id="recipient-name" value="">
             <div class="form-group">
                <label for="promocion" class="col-form-label">Precio promoción:</label>
                <input type="tel" name="promocion" class="form-control" maxlength="5" onkeypress="return numeros (event)"  id="promocion" required>
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
