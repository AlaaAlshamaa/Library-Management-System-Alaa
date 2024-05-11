<?php

namespace App\Models;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Auther extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name' , 'birth'
    ];

    public function books(){
        return $this->belongsToMany(Book::class,'auther_book');
    }

    public function reviews() {
        return $this->morphMany(Review::class,'reviewable');
    }
}
