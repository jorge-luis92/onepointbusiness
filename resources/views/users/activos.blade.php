@extends('layouts.app')

@section('content')
  <div class="container">
       @include('flash-message')
       <div class="row justify-content-center">
<div class="col-md-8">
  <div class="card">
      <div class="card-header" style="font-size: 1.0em; color: #000000;" align="center"><strong>{{ __('Usuarios activos') }}</strong></div>
    </br>
  <!--   <form action="/search" method="POST" role="search">
       {{ csrf_field() }}
      <div class="form-group col-md-4" align="center">
           <input type="text" class="form-control" name="q"  placeholder="Search users">
           <button type="submit" class="btn btn-default" name="Buscar">
     </button>
       </div>
    </form>-->
    <div class="table-responsive">
      <table class="table table-bordered table-striped" style="color: #000000;" id="users">
        <thead>
          <tr>
            <th scope="col">Usuariosss</th>
              <th scope="col">Email</th>

          </tr>
        </thead>
        <tbody>
          @foreach ($users as $usuarios)
        <tr>
               <th scope="row">{!! $usuarios->name !!}</th>
                <th scope="row">{!! $usuarios->email !!}</th>
                         </tr>
         @endforeach
      </tbody>
    </table>
  </div>

    </div>
</div>
</div>
</div>
</div>
</br>
</br>
</br>
</br>
</br>
</br>

@endsection
