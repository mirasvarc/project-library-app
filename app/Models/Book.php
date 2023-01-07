<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'genre',
        'description',
        'cover',
        'year',
        'pages',
        'quantity',
        'available',
    ];

    public function userBorrowsBooks() {
        return $this->hasMany('App\Models\UserBorrowsBook');
    }

    public function isAvailable() {
        if ($this->available > 0) {
            return true;
        } else {
            return false;
        }
    }


}
