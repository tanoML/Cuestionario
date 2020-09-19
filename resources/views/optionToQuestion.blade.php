@extends('panel')

@section('title', 'Forma de estudio')
@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Por favor elija su opcion de estudio</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a class="btn btn-secondary" href="{{ route('pSecuencial', $slug) }}">Secuencial</a>
        </div>
        <div class="col">
            <a class="btn btn-secondary" href="#">Aleatoria</a>
        </div>
    </div>
</div>

  <a href="{{ route('topics.index') }}">Regresar</a>

@endsection