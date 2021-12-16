@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{route('services.store')}}">
        @csrf

        <div class="mb-3 col">

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

         @error('color')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

            <label for="exampleFormControlInput1" class="form-label">Nombre de la categoría</label>
            <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1" placeholder="Hogar">
            
            <label for="exampleColorInput" class="form-label">Escoge un color para la categoría</label>
            <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="#563d7c" title="Choose your color">

            <input type="submit" value="Crear categoria" class="btn btn-primary my-2" />
        </div>
    </form>

    <div >
        @foreach ($services as $service)
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                    <a class="d-flex align-items-center gap-2" href="{{ route('services.show', ['service' => $service->id]) }}">
                        <span class="color-container" style="background-color: {{ $service->color }}"></span> {{ $service->name }}
                    </a>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal{{$service->id}}">Eliminar</button>
                    
                </div>
            </div>

            <!-- MODAL -->
            <div class="modal fade" id="modal{{$service->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar categoría</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Al eliminar la categoría <strong>{{ $service->name }}</strong> se eliminan todas las categorias asignadas a la misma. 
                        ¿Está seguro que desea eliminar la categoría <strong>{{ $service->name }}</strong>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No, cancelar</button>
                        <form action="{{ route('services.destroy', ['service' => $service->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-primary">Sí, eliminar categoía</button>
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