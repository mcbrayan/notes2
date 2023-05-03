@extends('adminlte::page')

@section('title', 'Coders Free')

@section('content_header')
    <h1>Crear Nota</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'note.store']) !!}
            {!! Form::hidden('user_id', Auth::user()->id) !!}

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
            <div class="form-grup mb-2">
                {!! Form::label('description', 'Descripcion') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

            </div>

            {!! Form::submit('Crear Nota', [
                'class' => 'btn btn-primary ',
            ]) !!}



            {!! Form::close() !!}
        </div>
    </div>
@stop
@section('js')
    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>



    <script>
        $(document).ready(function() {
            $("#title").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
