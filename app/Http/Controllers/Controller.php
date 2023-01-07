<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Book;
use App\Models\User;
use App\Models\UserBorrowsBook;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function exportData() {
        // create json file with all books data
        $books = Book::all();
        $books->toJson();

        $json = json_encode($books);
        $file = fopen('books.json', 'w');
        fwrite($file, $json);
        fclose($file);

        // create json file with all user data
        $users = User::all();
        $users->toJson();

        $json = json_encode($users);
        $file = fopen('users.json', 'w');
        fwrite($file, $json);
        fclose($file);

        $user_borrows = UserBorrowsBook::all();
        $user_borrows->toJson();

        $json = json_encode($user_borrows);
        $file = fopen('user_borrows.json', 'w');
        fwrite($file, $json);
        fclose($file);

        return redirect('/dashboard?export=success');

    }

    public function importData() {
        // load data from json
        $books = file_get_contents('books.json');
        $books = json_decode($books, true);
        
        foreach($books as $book) {
            if(!Book::where('title', $book['title'])->exists()) {
                $newBook = new Book();
                $newBook->title = $book['title'];
                $newBook->author = $book['author'];
                $newBook->genre = $book['genre'];
                $newBook->description = $book['description'];
                $newBook->cover = $book['cover'];
                $newBook->year = $book['year'];
                $newBook->pages = $book['pages'];
                $newBook->quantity = $book['quantity'];
                $newBook->available = $book['available'];
                $newBook->save();
            }
        }

        $users = file_get_contents('users.json');
        $users = json_decode($users, true);

        foreach($users as $user) {
            if(!User::where('email', $user['email'])->exists()) {
                $newUser = new User();
                $newUser->username = $user['username'];
                $newUser->email = $user['email'];
                $newUser->password = $user['password'];
                $newUser->is_admin = $user['is_admin'];
                $newUser->address = $user['address'];
                $newUser->firstname = $user['firstname'];
                $newUser->lastname = $user['lastname'];
                $newUser->pid = $user['pid'];
                $newUser->approved = $user['approved'];
                $newUser->save();
            }
        }

        $user_borrows = file_get_contents('user_borrows.json');
        $user_borrows = json_decode($user_borrows, true);

        foreach($user_borrows as $user_borrow) {
            if(!UserBorrowsBook::where('user_id', $user_borrow['user_id'])->where('book_id', $user_borrow['book_id'])->exists()) {
                $newUserBorrow = new UserBorrowsBook();
                $newUserBorrow->user_id = $user_borrow['user_id'];
                $newUserBorrow->book_id = $user_borrow['book_id'];
                $newUserBorrow->borrowed_at = $user_borrow['borrowed_at'];
                $newUserBorrow->returned_at = $user_borrow['returned_at'];
                $newUserBorrow->save();
            }
        }

        return redirect('/dashboard?import=success');
    }
}
