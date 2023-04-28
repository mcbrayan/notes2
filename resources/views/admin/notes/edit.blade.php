@extends('adminlte::page')

@section('title', 'Notes')

@section('content_header')
    <h1>Editar Notas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>

        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($note, ['route' => ['note.update', $note], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('title', 'Titulo') !!}
                {!! Form::text('title', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Ingrese el nombre de la Nota',
                ]) !!}

                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group">
                {!! Form::label('slug', 'Slug') !!}
                {!! Form::text('slug', null, [
                    'class' => 'form-control disabled',
                    'placeholder' => 'Ingrese el slug de la Nota',
                    'readonly',
                ]) !!}

                @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>

            {!! Form::submit('Actualizar Nota', [
                'class' => 'btn btn-primary',
            ]) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $("#title").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>
@endsection
