@extends('layouts.newmode')
@section('title')
: Configuración de cuenta
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cambio de Contraseña') }}</div>

                <div class="card-body">
                  @include('flash-message')
                                  <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}" validate enctype="multipart/form-data" data-toggle="validator">
                                      {{ csrf_field() }}

                                      <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} row">
                                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Actual') }}</label>

                                          <div class="col-md-6">
                                            <input id="current-password" type="password" class="form-control" name="current-password" value="{{ old('current-password') }}" required>

                                            @if ($errors->has('current-password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('current-password') }}</strong>
                                                </span>
                                            @endif
                                          </div>
                                      </div>



                                      <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }} row">
                                          <label for="new-password" class="col-md-4 col-form-label text-md-right" >Nueva Contraseña</label>

                                          <div class="col-md-6">
                                              <input id="new-password" type="password" class="form-control" value="{{ old('new-password') }}" name="new-password" required>

                                              @if ($errors->has('new-password'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('new-password') }}</strong>
                                                  </span>
                                              @endif
                                            </div>
                                      </div>

                                      <div class="form-group row">
                                          <label for="new-password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>
                                          <div class="col-md-6">
                                              <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" value="{{ old('new-password_confirmation') }}"required>
                                          </div>
                                      </div>

                                      <div class="form-group row mb-0">
                                          <div class="col-md-6 offset-md-4">
                                              <button type="submit" class="btn btn-primary">
                                                  {{ __('Actualizar Contraseña') }}
                                              </button>
                                          </div>
                                      </div>

                                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
