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

            <div class="form-grup mb-2">

                {!! Form::label('description', 'Descripcion') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

            </div>

            <div class="row mb-3">
                <div class="col">
                    <div class="image-wrapper">
                        @if (count($note->files) > 0)
                            <img id="picture" src="{{ Storage::url($note->files[0]->title) }}"alt="">
                        @endif

                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('file', 'imagen que se mostrara en la nota') !!}
                        {!! Form::file('file', ['class' => 'form - control - file']) !!}
                    </div>



                </div>
            </div>


            {!! Form::submit('Actualizar Nota', [
                'class' => 'btn btn-primary btn-sm',
            ]) !!}

            {!! Form::close() !!}
        </div>
    </div>
    <div>
        @if (count($note->files) > 0)
            <form method="POST" action="{{ route('file.destroy', $note->files[0]->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        @endif
    </div>
@stop

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
