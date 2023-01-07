<x-app-layout>
 
    <div class="p-20">
        <div class="flex">
            <img src="{{ $book->cover }}" width="250px" style="height:fit-content;">
            <div class="pl-20">
                <h1 class="text-3xl font-normal dark:text-white">{{$book->title}}</h1>
                <p class="text-s font-normal dark:text-white">Author: {{$book->author}}</p>
                <br>
                <p class="text-s font-normal dark:text-white">Published: {{$book->year}}</p>
                <p class="text-s font-normal dark:text-white">Genre: {{$book->genre}}</p>
                <p class="text-s font-normal dark:text-white">Pages: {{$book->pages}}</p>
                <br>
                <p class="text-m font-normal dark:text-white">{{$book->description}}</p>
                <br><br>
                <p class="text-s font-normal dark:text-white">Available: {{$book->available}}</p>
                <br>
                @if(Auth::user()->approved)
                    @if(Auth::user()->hasBorrowedBook($book->_id))
                        <p class="text-xl font-normal dark:text-white">You have already borrowed this book</p>
                    @elseif(Auth::user()->borrowedBooksCount() >= 6) 
                        <p class="text-xl font-normal dark:text-white">You have reached the maximum number of books you can borrow</p>
                    @else
                        <a href="{{ route('books.borrow', $book->_id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Borrow book</a>
                    @endif
                @else
                    <p class="text-xl font-normal dark:text-white">Your account is not approved yet.</p>
                @endif
                <br>
                <hr class="mt-10">
                @if(Auth::user()->is_admin)
                <div class="flex mt-5 items-center">
                    <label for="borrow_for" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400 w-32">Borrow book for:</label>
                    <select id="borrow_for" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-48 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->firstname}} {{$user->lastname}}</option>
                        @endforeach
                    </select>
                    <a href="javascript:void(0);" onclick="borrowBookForUser('{{$book->_id}}')" class="ml-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Borrow book</a>
                </div>
                @endif
            </div>
        </div>


    </div>

    <script>
        function borrowBookForUser(bookId) {
            var userId = document.getElementById('borrow_for').value;
            window.location.href = '/book/' + bookId + '/borrowfor/' + userId;
        }
    </script>

</x-app-layout>