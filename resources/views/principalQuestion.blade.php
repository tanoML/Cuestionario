@extends('panel')

@section('title', 'Preguntas')


@section('content')

@if ($questions->isEmpty())
  <nothing-component></nothing-component>
@else

  @if (session('messages'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('messages') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
  </div>
  @endif

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Pregunta</th>
                <th scope="col">Respuesta</th>
                <th scope="col">Editar pregunta</th>
                <th scope="col">Eliminar pregunta</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($questions as $key => $item)
                <tr>
                  <th scope="row">{{ $key+1 }}</th>
                  <td>{{ $item->pregunta }}</td>
                  <td>{{ $item->respuesta }}</td>
                  <td><a class="btn btn-warning" href="#">Editar</a></td>
                  <td>
                    {{-- <a class="btn btn-danger" href="#">Eliminar</a> --}}
                    <form action="{{ route('deleteQ',[ $slug, $item->id ]) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
  </div>
@endif

  <br>

  <a href="" class="btn btn-primary">Agregar preguntas</a>

  <a href="{{ route('topics.index') }}">Regresar</a>

@endsection