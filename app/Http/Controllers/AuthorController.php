<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    public function getFemouseAuthors()
    {
        try {
            $result = DB::table('authors as a')
            ->join('books as b','b.author_id', '=', 'a.id')
            ->join('ratings as r','r.book_id', '=', 'b.id')
            ->select(
                'a.id',
                'a.name',
                DB::raw('COUNT(r.id) as total_voter')
            )
            ->groupBy('a.id', 'a.name')
            ->orderByDesc('total_voter')
            ->having('total_voter', '>=', '5')
            ->limit(10)
            ->get();

            return response()->json([
                'success' => true,
                'data' => $result
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
   
    }
    
    public function getAuthors()
    {
        try {
            $result = Author::all();

            $formated = $result->map(function($author){
                return [
                    'id' => $author->id,
                    'name' => $author->name,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formated
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getBooks($id)
    {
        try {
            $result = Book::where('author_id', $id)->get();
            $formated = $result->map(function($book){
                return [
                    'id' => $book->id,
                    'title' => $book->title
                ];
            });
            return response()->json([
                'success' => true,
                'data' => $formated
            ], 200); 
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
};
