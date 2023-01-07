<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class UserBorrowsBook extends Model
{
    use HasFactory;

    protected $table = 'user_borrows_book';

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'returned_at',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function book() {
        return $this->belongsTo('App\Models\Book');
    }


}
