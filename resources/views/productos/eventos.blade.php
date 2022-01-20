@extends('layouts.newmode')
@section('title')
: Registro de eventos
@endsection
@section('content')
<div class="container">
     @include('flash-message')
     <div class="row justify-content-center">
         <div class="col-md-12">
             <div class="card">
                                   <div class="table-responsive">
       <table class="table table-bordered table-striped" style="color: #000000; font-size: 14px;" id="eventos_table">
         <thead>
           <tr>
             <th scope="col">Fecha</th>
               <th scope="col">Nombre de Usuario</th>
               <th scope="col">Producto afectado</th>
              <th scope="col">Tipo de evento</th>
              <th scope="col">cantidad</th>
              <th scope="col">Motivo</th>
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
   <script type="text/javascript" src="{{ asset('js/events.js')}}"></script>

   @endsection
