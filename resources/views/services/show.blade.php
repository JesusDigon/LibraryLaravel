@extends('app')

@section('content')

<div class="container border p-4">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form  method="POST" action="{{route('services.update',['service' => $service->id])}}">
                @method('PATCH')
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

                    <label for="exampleFormControlInput1" class="form-label">Nombre del servicio</label>
                    <input type="text" class="form-control mb-2" name="name" id="exampleFormControlInput1" placeholder="Hogar" value="{{ $service->name }}">
                    
                    <label for="exampleColorInput" class="form-label">Escoge un color para el servicio</label>
                    <input type="color" class="form-control form-control-color" name="color" id="exampleColorInput" value="{{ $service->color }}" title="Choose your color">

                    <input type="submit" value="Actualizar servicio" class="btn btn-primary my-2" />
                </div>
            </form>

            <div >
            @if ($service->payments->count() > 0)
                @foreach ($service->payments as $payment )
                    <div class="row py-1">
                        <div class="col-md-9 d-flex align-items-center">
                            <a href="{{ route('payment-edit', ['id' => $payment->id]) }}">{{ $payment->title }}</a>
                        </div>

                        <div class="col-md-3 d-flex justify-content-end">
                            <form action="{{ route('payment-destroy', [$payment->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @endforeach    
            @else
                No hay pagos para esta servicio
            @endif
            
            </div>
        </div>
    </div>
</div>
@endsection