<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    public function createRating(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'rating' => 'required|integer|min:1|max:10',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->all() 
                ], 400);
            }
            
            $rating = $request->input('rating');
            $result = Book::where('book_id', $id);

            if(!$result){
                return response()->json([
                    'success' => false,
                    'message' => ['Book not found'] 
                ], 404);
            }
            if($result){
                Rating::create([
                    'rating' => $rating,
                    'book_id' => $id 
                ]);
            }

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
}
