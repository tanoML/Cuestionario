@extends('panel')
@section('title', 'Cuestionario')
@section('content')

<div class="container">
  <div class="row">
   <div class="col">
    <div class="jumbotron">
      <form method="POST" action="{{ route('pCheck',$slug) }}">
        @csrf
        <h2 class="display-5">{{ $pregunta }}</h2>
        <div class="form-group form-check">
          {{-- start to checkbox for answer --}}
          @foreach ($respuestas as $key => $item)
            <div class="form-check">
              <input name="respuesta" class="form-check-input" type="radio" id="exampleRadios{{$key}}" 
              value="{{ $item->respuesta }}" required 
              @if(session('messagesCorrect') || session('messagesWrong')) 
              disabled
                @if (session('messagesCorrect'))
                    @if( $item->respuesta === $respuestaOrig) 
                      checked 
                    @endif
                @else
                    @if( $item->respuesta === session('answerIncorrect')) 
                      checked 
                    @endif
                @endif
              @endif >
              {{-- end this is for disabled when is answering the Q --}}
              <label class="form-check-label" for="exampleRadios{{$key}}">
                {{ $item->respuesta }}
              </label>
            </div>
          @endforeach
          {{-- end to checkbox for answer --}}
        </div>
        <button type="submit" class="btn btn-primary" @if(session('messagesCorrect') || session('messagesWrong')) disabled @endif >Calificar</button>
      </form>

      <hr>

      {{-- here we have the seccion for message --}}
    @if (session('messagesCorrect') || session('messagesWrong'))
        <div class="container">
          <h2 class="display-5">
            @if (session('messagesCorrect'))
              {{ session('messagesCorrect') }} 
            @else
              {{session('messagesWrong') }} <br> Respuesta correcta: {{ $respuestaOrig }}. <br> Por favor continue.
            @endif
          </h2>
          <a class="btn btn-success" href="{{ route('pContinueQ',$slug) }}">Continuar</a>
      </div> 
    @endif

    </div>
   </div>

  </div>
  <div class="row">
    <div class="col">


    </div>
  </div>
</div>
  <a href="{{ route('topics.index') }}" class="btn btn-primary">Salir del cuestionario</a>
@endsection