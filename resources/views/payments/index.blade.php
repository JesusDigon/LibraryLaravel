@extends('app')

@section('content')

<div class="container border p-4">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <form  method="POST" action="{{route('payments')}}">
                @csrf

                <div class="mb-3 col">
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                @if (session('success'))
                        <h6 class="alert alert-success">{{ session('success') }}</h6>
                @endif
                    <label for="title" class="form-label">Título del pago</label>
                    <input type="text" class="form-control mb-2" name="title" id="exampleFormControlInput1" placeholder="Primer pago">
                    
                    <label for="date" class="form-label">Fecha del pago</label>
                    <input type="date" class="form-control mb-2" name="date" id="exampleFormControlInput1" placeholder="{{ date('d-m-Y') }}">
                    
                    <label for="cost" class="form-label">Precio: </label>
                    <input type="number" class="form-control mb-2" name="cost" id="exampleFormControlInput1" placeholder="€€">

                    <div class="form-check form-switch" >
                        <input class="form-check-input form-control mb-2" type="checkbox" id="status" value="1" name="status">
                        <label class="form-check-label form-label" for="status">Pagado</label>
                    </div>

                    

                    <label for="service_id" class="form-label">Servicio del pago</label>
                    <select name="service_id" class="form-select">
                        @foreach ($services as $service)
                            <option value="{{$service->id}}">{{$service->name}}</option>
                        @endforeach
                    </select>
                    <input type="submit" value="Crear pago" class="btn btn-primary my-2" />
                </div>
            </form>
        </div>
        <div >
            @foreach ($payments as $payment)
            
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
        </div>
    </div>
</div>

@endsection