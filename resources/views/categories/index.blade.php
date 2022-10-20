@extends('app')

@section('content')
<div class="container w-25 border p-4 my-4">
    <div class="row mx-auto">
        <form action="{{ route('categories.store') }}" method="POST">
            <!-- Cross Site Request Forgery 
        Permite enviar datos de un formulario    
        -->
            @csrf

            <!-- respuestas -->
            @if (session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
            @endif

            @error('name')
            <h6 class="alert alert-danger">{{$message}}</h6>
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la categoría</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color de la Categoría</label>
                <input type="color" class="form-control" id="color" name="color">
            </div>

            <button type="submit" class="btn btn-primary">Crear nueva Categoría</button>
        </form>

        <div class="mt-5">
            @foreach ($categories as $category)
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                    <a class="d-flex align-items-center gap-2" href="{{ route('categories.show', ['category' => $category->id]) }}">
                        <span class="color-container" style="background-color: {{ $category->color }}"></span> {{$category->name}}
                    </a>
                </div>
                <!-- Button trigger modal -->
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#{{$category->name}}">
                        Eliminar
                    </button>
                </div>
            </div>



            <div class="modal fade" id="{{$category->name}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Al eliminar la categoría <strong>{{ $category->name }}</strong> se eliminan todas las tareas asignadas a la misma.
                            ¿Seguro que desea eliminar la categoría <strong>{{ $category->name }}</strong> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




            @endforeach
        </div>
    </div>
</div>
@endsection