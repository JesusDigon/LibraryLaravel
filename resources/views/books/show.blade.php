@extends('app')

@section('content')

<div class="container w-25 border p-4">
    <div class="row mx-auto">
    <form  method="POST" action="{{ route('book-update', ['id' => $book->id]) }}">
        @method('PATCH')
        @csrf

        <div class="mb-3 col">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <label for="title" class="form-label">Título del libro</label>
            <input type="text" class="form-control mb-2" name="title" id="exampleFormControlInput1" placeholder="El señor de los anillos" value="{{ $book->title }}">

            <label for="summary" class="form-label">Sinópsis</label>
            <textarea class="form-control mb-2" name="summary" id="exampleFormControlInput1" placeholder="{{ $book->summary }}">{{ $book->summary }}</textarea>
            
            <label for="cost" class="form-label">Precio: </label>
            <input type="number" class="form-control mb-2" name="cost" id="exampleFormControlInput1" placeholder="€€" value="{{ $book->cost }}">

             <label for="category_id" class="form-label">Categoria del libro</label>
            <select name="category_id" class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <input type="submit" value="Actualizar libro" class="btn btn-primary my-2" />
        </div>
    </form>

    
    </div>
</div>
@endsection