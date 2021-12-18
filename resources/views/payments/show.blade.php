@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{ route('payment-update', ['id' => $payment->id]) }}">
        @method('PATCH')
        @csrf

        <div class="mb-3 col">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <label for="title" class="form-label">Título del pago</label>
            <input type="text" class="form-control mb-2" name="title" id="exampleFormControlInput1" placeholder="El señor de los anillos" value="{{ $payment->title }}">

            <label for="summary" class="form-label">Sinópsis</label>
            <textarea class="form-control mb-2" name="summary" id="exampleFormControlInput1" placeholder="{{ $payment->summary }}">{{ $payment->summary }}</textarea>
            
            <label for="cost" class="form-label">Precio: </label>
            <input type="number" class="form-control mb-2" name="cost" id="exampleFormControlInput1" placeholder="€€" value="{{ $payment->cost }}">

             <label for="category_id" class="form-label">Servicio del pago</label>
            <select name="category_id" class="form-select">
                @foreach ($services as $service)
                    <option value="{{$service->id}}">{{$service->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Actualizar pago" class="btn btn-primary my-2" />
        </div>
    </form>

    
    </div>
</div>
@endsection