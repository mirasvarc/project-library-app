<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Models\Book;	
use App\Models\UserBorrowsBook;
use Illuminate\Support\Carbon;

class User extends Authenticatable implements AuthenticatableContract
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userIsAdmin() {
        
        if ($this->is_admin == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function hasBorrowedBook($book_id) {
        $user_borrows_book = UserBorrowsBook::where('user_id', $this->id)->where('book_id', $book_id)->where('returned_at', null)->first();
        if ($user_borrows_book) {
            return true;
        } else {
            return false;
        }
    }

    public function borrowedBooks() {
        $user_borrows_books = UserBorrowsBook::where('user_id', $this->id)->get();
        $books = [];
        foreach ($user_borrows_books as $key => $user_borrows_book) {
            $book = Book::find($user_borrows_book->book_id);
            $books[$key]['book'] = $book;
            $books[$key]['borrowed_at'] = $user_borrows_book->borrowed_at;
            $books[$key]['returned_at'] = $user_borrows_book->returned_at;
        }
        return $books;
    }

    public function borrowedBooksCount() {
        $user_borrows_books = UserBorrowsBook::where('user_id', $this->id)->where('returned_at', null)->get();
        return count($user_borrows_books);
    }



}
