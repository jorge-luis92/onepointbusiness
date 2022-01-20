@extends('layouts.newmode')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-12">
          @include('flash-message')
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body" align="center" style="background-image: url('./image/frutal.png'); background-position:center; background-repeat: no-repeat; position: relative; background-color: #E8C6E9;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Welcome ') }} <strong>{{ Auth::user()->name }}</strong>
                  </br>
                  </br>
                  </br>
                  </br>
                </br>
                </br>
                </br>
                </br>
                </br>
              </br>
              </br>




                </div>
            </div>
        </div>
    </div>

</div>


@endsection
