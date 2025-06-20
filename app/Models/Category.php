<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 protected $fillable = ['category', 'book_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
