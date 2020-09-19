@extends('panel')
@section('title', 'Agregar preguntas')
@section('content')

<div class="container">

  @if (session('messagesQ'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('messagesQ') }} <a href="#">puede empezar a practicar</a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

    <form method="POST" action="{{ route('saveQ', $topic) }}">
      @csrf
        <div class="form-group">
          <label for="pregunta">Agregar pregunta</label>
          <input name="pregunta" type="text" class="form-control" id="pregunta" aria-describedby="emailHelp" required>
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="respuesta">Agregar la respuesta correcta</label>
          <input name="respuesta" type="text" class="form-control" id="respuesta" required>
        </div>
      
        <button type="submit" class="btn btn-primary">Registrar</button>
      </form>
      
    <br>
    <a href="{{ route('topics.index') }}" class="btn btn-primary">regresar</a>   
</div>
@endsection