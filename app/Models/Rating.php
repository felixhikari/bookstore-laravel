<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
 protected $fillable = ['rating', 'book_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
