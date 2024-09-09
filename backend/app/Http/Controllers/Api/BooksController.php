<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Books;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Validator;

class BooksController extends Controller
{
    public function index()
    {
        $books = Books::get();
        if ($books->count() > 0) {
            return BookResource::collection($books);
        } else {
            return response()->json(['message' => 'No books found'], 404);
        }
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'publishYear' => 'required|integer',
            'author' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'All fields are required'
            ], 400);
        }

        $book = Books::create([
            'title' => $request->title,
            'publishYear' => $request->publishYear,
            'author' => $request->author,
        ]);
        return response()->json([
            'book' => new BookResource($book),
            'message' => 'Book created successfully'
        ], 200);
    }
    public function show(Books $book)
    {
        return new BookResource($book);
    }
    public function update(Request $request, Books $book)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'publishYear' => 'required|integer',
            'author' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'All fields are required'
            ], 400);
        }

        $book->update([
            'title' => $request->title,
            'publishYear' => $request->publishYear,
            'author' => $request->author,
        ]);
        return response()->json([
            'book' => new BookResource($book),
            'message' => 'Book updated successfully'
        ], 200);
    }
    public function destroy(Books $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
