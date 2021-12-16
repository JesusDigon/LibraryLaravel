@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{route('payments')}}">
        @csrf

        <div class="mb-3 col">
        @error('title')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
            <label for="title" class="form-label">Título del libro</label>
            <input type="text" class="form-control mb-2" name="title" id="exampleFormControlInput1" placeholder="El señor de los anillos">
            
            <label for="summary" class="form-label">Sinópsis</label>
            <textarea class="form-control mb-2" name="summary" id="exampleFormControlInput1" placeholder="Breve resumen del tema del libro"></textarea>
            
            <label for="cost" class="form-label">Precio: </label>
            <input type="number" class="form-control mb-2" name="cost" id="exampleFormControlInput1" placeholder="€€">

            <label for="category_id" class="form-label">Categoria del libro</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Crear libro" class="btn btn-primary my-2" />
        </div>
    </form>
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