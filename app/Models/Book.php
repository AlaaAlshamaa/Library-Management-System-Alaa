<?php

namespace App\Models;

use App\Models\User;
use App\Models\Auther;
use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\ManageBorrowOperation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory,ManageBorrowOperation;

    protected $fillable = [
        'title',
        'available',
        'amount',
        'published_at',
        'city',
    ];

    public function authers(){
        return $this->belongsToMany(Auther::class,'auther_book');
    }

    public function reviews() {
        return $this->morphMany(Review::class,'reviewable');
    }

    public function users(){
        return $this->belongsToMany(User::class,'book_user')->withTimestamps();;
    }

}

