@extends('adminlte::page')

@section('title', 'Listado de Notas')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Lista de Notas</h1>
        <a class="btn btn-secondary" href="{{ route('note.create') }}">Agregar Nota</a>
    </div>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>

        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <input wire:model="search" class="form-control" placeholder="Ingrese el nombre de la nota">
            <button class="btn btn-primary">
                Buscar Nota
            </button>
        </div>



        <div class="card-body">

            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Hora</th>
                        <th>Descripcion</th>
                        <th colspan="2"></th>
                    </tr>

                </thead>
                @foreach ($notes as $note)
                    <tr>
                        <td>{{ $note->id }}</td>
                        <td>{{ $note->title }}</td>
                        <td>{{ $note->created_at }}</td>
                        <td>{{ $note->description }}</td>
                        <td width="10px">
                            <a class="btn btn-primary btn-sm" href="{{ route('note.edit', $note) }}">Editar</a>
                        </td>
                        <td width="10px">
                            <form method="POST" action="{{ route('note.destroy', $note) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <tbody>


                </tbody>

            </table>

        </div>

    </div>
    <div class="card-footer">
        {{ $notes->links() }}
    </div>
@stop
