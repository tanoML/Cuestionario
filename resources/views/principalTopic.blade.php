@extends('panel')

@section('title', 'Agregar temas')
@section('content')
@if ($topics->isEmpty())
  <example-component></example-component>
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
                <th scope="col">Titulo</th>
                <th scope="col">Practicar</th>
                <th scope="col">Preguntas</th>
                <th scope="col">Respuestas</th>
                <th scope="col">Editar titulo</th>
                <th scope="col">Eliminar tema</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($topics as $key => $item)
                <tr>
                  <th scope="row">{{ $key+1 }}</th>
                  <td>{{ $item->tema }}</td>
                  <td><a class="btn btn-success" href="{{ route('panelQ', $item->slug) }}">Empezar</a></td>
                  <td>
                    <a href="{{ route('addQ', $item->slug) }}" class="btn btn-primary">Agregar</a>
                  </td>
                  <td><a class="btn btn-secondary" href="{{ route('principalQ', $item->slug) }}">Ver</a></td>
                  <td><a class="btn btn-warning" href="{{ route('topics.edit', $item->slug) }}">Editar</a></td>
                  <td>
                    <form action="{{ route('topics.destroy',$item->slug) }}" method="post">
                      @csrf 
                      @method('DELETE') 
                      <button class="btn btn-danger" type="submit">Eliminar</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
          {{ $topics->links() }}
    </div>
  </div>
@endif

  <br>

  <a href="{{ route('topics.create') }}" class="btn btn-primary">Agregar temas</a>

  <a href="{{ url('/') }}">Regresar</a>

@endsection