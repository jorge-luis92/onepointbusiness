@extends('layouts.newmode')
@section('title')
: Usuarios
@endsection
@section('content')
<div class="container-fluid">
     @include('flash-message')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

              <div class="form-group row">
              <div class="col-md-4">
                <button type="button" class="btn btn-outline-primary btn-sm btnNuevo" data-toggle="tooltip" title="Nuevo">Nuevo Usuario
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-plus-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm7.5-3a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"></path>
              </svg>
                      </button>
              </div>
            </div>

              </br>
                                <div class="table-responsive">

                    <table class="table table-bordered table-striped" style="color: #000000;" id="users">
                      <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Email</th>
                            <th scope="col">Tipo de Usuario</th>
                            <th scope="col">Acciones</th>
                        </tr>
                      </thead>
                <tbody></tbody>
                  </table>

                          </div>

        </div>
    </div>

</div>


<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formUsuarios">
           @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Nombre de Usuario:</label>
                    <input type="text" name="user"class="form-control" id="username">
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Tipo de usuario</label>
                  <select name="type" id="types" required class="form-control">
                 <option value="" >Seleccione una opción</option>
                  <option value="Administrador">Administrador</option>
                     <option value="Vendedor">Vendedor</option>

            </select>
                    </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btnBorrar" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Actualizar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alta de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formNuevo">
           @csrf
            <div class="modal-body">

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de Usuario') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de Usuario') }}</label>

        <div class="col-md-6">
          <select name="type" id="tipo" required class="form-control">
       <option value="">Seleccione una opción</option>
        <option value="Administrador">Administrador</option>
           <option value="Vendedor">Vendedor</option>

  </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light btnBorrars" data-dismiss="modal">Cancelar</button>
        <button type="submit" id="btnGuardars" class="btn btn-dark">Registrar</button>
    </div>
</form>

<!-- final modal-->
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
<script type="text/javascript" src="js/users.js"></script>

@endsection
