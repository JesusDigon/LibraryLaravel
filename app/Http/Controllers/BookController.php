<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('books.index', ['books' => $books, 'categories' => $categories]);
    }

    public function store(Request $request){

        $request->validate([
            'title' => 'required|min:3',
            'summary' => 'string',
            'cost' => 'required',
            'category_id' => 'required',
        ]);
    
        $book = new Book;
        $book->title = $request->title;
        $book->summary = $request->summary;
        $book->cost = $request->cost;
        $book->category_id = $request->category_id;
        $book->save();
    
        return redirect()->route('books')->with('success', 'book created successfully');
    }

    public function destroy($id){
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('books')->with('success', 'book deleted successfully');
    }

    public function show($id){
        $book = Book::find($id);
        $categories = Category::all();
        return view('books.show', ['book' => $book, 'categories' => $categories]);
    }

    public function update(Request $request, $id){
        $book = Book::find($id);
        
        $book->title = $request->title;
        $book->summary = $request->summary;
        $book->cost = $request->cost;
        $book->save();

        return redirect()->route('books')->with('success', 'book updated successfully');
    }
}
