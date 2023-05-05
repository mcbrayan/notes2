@extends('adminlte::page')

@section('title', 'notas')

@section('content_header')
    <h1>Crear Nota</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'note.store', 'files' => true]) !!}
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

            <div class="row mb-3">
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('file') !!}
                        {!! Form::file('file', ['class' => 'form - control - file']) !!}
                    </div>



                </div>
            </div>


            {!! Form::submit('Crear Nota', [
                'class' => 'btn btn-primary ',
            ]) !!}



            {!! Form::close() !!}
        </div>
    </div>

@section('css')
    <style>
        .image-wrapper {
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
@stop

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

    document.getElementById("file").addEventListener('change', cambiarImagen);

    function cambiarImagen(event) {

        var file = event.target.files[0];

        var reader = new FileReader();

        reader.onload = (event) => {

            document.getElementById("picture").setAttribute('src', event.target.result)

        };

        reader.readAsDataURL(file);

    }
</script>
@endsection
