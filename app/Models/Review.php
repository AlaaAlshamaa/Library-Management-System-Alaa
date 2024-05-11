<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'review',
        'user_id'
    ];
    
    
    public function reviewable(){
        return $this->morphTo();
    }

    public function user() {
        $this->belongsTo(User::class);
    }

}
