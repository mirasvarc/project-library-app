<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\UserBorrowsBook;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('cover')) {
            $fileName = time().'_'.$request->file('cover')->getClientOriginalName();
            $filePath = $request->file('cover')->storeAs('uploads', $fileName, 'public');
        }
        
    
        $book = new Book();

        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->description = $request->description;
        $book->cover = '/storage/' . $filePath;
        $book->year = $request->year;
        $book->pages = $request->pages;
        $book->quantity = $request->quantity;
        $book->available = $request->quantity;

        $book->save();

        return redirect('/library')->with('success', 'Book saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);

        $users = User::all();

        return view('books.show', compact('book', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);

        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if($request->file('cover')) {
            $fileName = time().'_'.$request->file('cover')->getClientOriginalName();
            $filePath = $request->file('cover')->storeAs('uploads', $fileName, 'public');
        }

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->genre = $request->genre;
        $book->description = $request->description;
        if($request->file('cover')) {
            $book->cover = '/storage/' . $filePath;
        }
        $book->year = $request->year;
        $book->pages = $request->pages;
        $book->quantity = $request->quantity;
        $book->available = $request->quantity;

        $book->save();

        return redirect('/library')->with('success', 'Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if(UserBorrowsBook::where('book_id', $id)->exists()) {
            return redirect('/library')->with('error', 'You can delete book, when it is borrowed!');
        }

        $book->delete();

        return redirect('/books')->with('success', 'Book deleted!');
    }

    
    public function getAllBooks() {

        $title  = null;
        $author = null;
        $year   = null;

        if(strlen(request('title')) > 3) {
            $title = request('title');
        }
        if(strlen(request('author')) > 3) {
            $author = request('author');
        }
        if(strlen(request('year')) > 3) {
            $year = request('year');
        }


        if(($title == null && $author == null && $year == null) || ($title == 'null' && $author == 'null' && $year == 'null')) {
            $books = Book::orderBy(request('sortBy'), request('sortDirection'))->get();
        } else {
            $books = Book::select('id', 'title', 'author', 'year', 'quantity', 'created_at')
                        ->when($title, function($query, $title) {
                            return $query->where('title', 'like', '%'.$title.'%');
                        })
                        ->when($author, function($query, $author) {
                            return $query->where('author', 'like', '%'.$author.'%');
                        })
                        ->when($year, function($query, $year) {
                            return $query->where('year', 'like', '%'.$year.'%');
                        })
                        ->orderBy(request('sortBy'), request('sortDirection'))
                        ->get();
        }

 
        return json_encode($books);
    }

    public function borrowBook($id) {

        $book = Book::find($id);

        if($book->available > 0) {

            $user_borrows_book = new UserBorrowsBook();
            $user_borrows_book->user_id = Auth::user()->id;
            $user_borrows_book->book_id = $id;
            $user_borrows_book->borrowed_at = date('Y-m-d H:i:s');
            $user_borrows_book->save();

            $book->available = $book->available - 1;
            $book->save();
            return redirect('/my-library')->with('success', 'Book borrowed!');
        } else {
            return redirect('/my-library')->with('error', 'Book not available!');
        }
    }

    public function borrowBookForUser($id, $user_id) {

        $book = Book::find($id);

        if($book->available > 0) {

            $user_borrows_book = new UserBorrowsBook();
            $user_borrows_book->user_id = $user_id;
            $user_borrows_book->book_id = $id;
            $user_borrows_book->borrowed_at = date('Y-m-d H:i:s');
            $user_borrows_book->save();

            $book->available = $book->available - 1;
            $book->save();
            return redirect('/library')->with('success', 'Book borrowed!');
        } else {
            return redirect('/library')->with('error', 'Book not available!');
        }
    }

    public function returnBook($id) {

        $user_borrow_book = UserBorrowsBook::where('user_id', Auth::user()->id)->where('book_id', $id)->where('returned_at', null)->first();
        $book = Book::find($id);

        if($user_borrow_book) {
            $user_borrow_book->returned_at = date('Y-m-d H:i:s');
            $user_borrow_book->save();
            $book->available = $book->available + 1;
            $book->save();
            return redirect('/my-library')->with('success', 'Book returned!');
        } else {
            return redirect('/my-library')->with('error', 'Book not borrowed!');
        }
    }
}
