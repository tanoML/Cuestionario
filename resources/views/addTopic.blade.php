@extends('panel')
@section('title', 'Agregar temas')
@section('content')

<div class="container">

    <form method="POST" action="{{  route('topics.store') }}">
        @csrf
        <div class="form-group">
          <label for="tema">Tema</label>
          <input name="topics" type="text" class="form-control" id="tema" aria-describedby="temaHelp" required>
          <small id="temaHelp" class="form-text text-muted">Por favor agregue un tema correcto</small>
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>


    <br>

    <a href="{{ route('topics.index') }}" class="btn btn-primary">regresar</a>   
</div>

 

@endsection