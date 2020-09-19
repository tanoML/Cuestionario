@extends('panel')
@section('title', 'Editar tema')
@section('content')

<div class="container">

    <form method="POST" action="{{  route('topics.update', $tema->slug) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="tema">Tema</label>
          <input name="topicNew" type="text" class="form-control" id="tema" aria-describedby="temaHelp" placeholder="{{ $tema->tema }}" required>
          <small id="temaHelp" class="form-text text-muted">Por favor cambie su tema</small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
      </form>


    <br>

    <a href="{{ route('topics.index') }}" class="btn btn-primary">regresar</a>   
</div>

 

@endsection