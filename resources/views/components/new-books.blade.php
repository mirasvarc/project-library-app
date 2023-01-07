@php
    $books = App\Models\Book::orderBy(
        'created_at', 'desc'
    )->take(5)->get();  
@endphp

<h1 class="p-4 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Recently added books</h1>
<div class="flex">
    @foreach($books as $book)
    <div class="m-2 w-56 max-w-sm bg-white rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
        <a href="/library/{{$book->_id}}">
            <img class="p-8 rounded-t-lg" src="{{$book->cover}}" width="100%" alt="product image">
        </a>
        <div class="px-5 pb-5">
            <a href="/library/{{$book->_id}}" class="h-32">
                <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$book->title}}</h5>
            </a>
            <br>
            <div class="flex justify-between items-center">
                <a href="/library/{{$book->_id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Show detail</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
