<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function getBooks()
    {
        try {
            $result = Book::all();
            $formated = $result->map(function($book){
                return [
                    'id' => $book->id,
                    'title' => $book->title,
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

    public function getAuthor($id)
    {
        try {
            $result = Book::find($id);

            if(!$result){
                return response()->json([
                    'success' => false,
                    'message' => ['Author not found'] 
                ], 404);
            }

            $author = Author::find($result->author->id);
            $formated = [
                'id' => $author->id,
                'name' => $author->name,
            ];
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

    public function searchBooks(Request $request)
    {
        try {
            $validator = Validator::make($request->query(), [
                'limit' => 'required|integer|min:1|max:100'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->all() 
                ], 400);
            }

            $search = $request->query('title');
            $limit = $request->query('limit');

            $result = null;
            if (empty(trim($search))) {
                $result = Book::with(['author', 'category'])
                    ->withCount('ratings as total_voter')
                    ->orderByDesc('total_voter')
                    ->limit($limit)
                    ->get();
            } else {
                $result = Book::with(['author', 'category'])
                    ->withCount('ratings as total_voter') // hitung jumlah rating sebagai total_voter
                    ->whereRaw('LOWER(title) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('author', function ($query) use ($search) {
                        $query->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    })
                    ->orderByDesc('total_voter')
                    ->limit($limit)
                    ->get();
            }
            
            $formated = $result->map(function ($book) {
                $average_rating = $book->ratings()->avg('rating');
                $voter = $book->ratings()->count();
            
                return [
                    'title' => $book->title,
                    'name' => $book->author?->name,
                    'category' => $book->category?->category,
                    'average_rating' => round($average_rating ?? 0, 2),
                    'total_voter' => $voter,
                ];
            });


            $array = $formated->toArray();
            usort($array, function($a, $b){
                return $b['average_rating'] <=> $a['average_rating'];
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
}
