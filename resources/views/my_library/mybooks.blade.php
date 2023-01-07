<x-app-layout>
    
    <div class="p-10">
        <h1 class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-5">My books</h1>
        <div id="search-box" class="mt-2 mb-10" style="display: none;">
            <form>
                <p class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-5">Search book:</p>
                <div class="flex items-center">
                    <label for="title" class="mr-2 block text-l font-medium text-gray-700 dark:text-gray-200 w-16">Title</label>
                    <input type="text" name="title" id="title" class="form-input rounded-md shadow-sm mt-1 block" />
                </div>
                <div class="flex items-center">
                    <label for="author" class="mr-2 block text-l font-medium text-gray-700 dark:text-gray-200 w-16">Author</label>
                    <input type="text" name="author" id="author" class="form-input rounded-md shadow-sm mt-1 block" />
                </div>
                <div class="flex items-center">
                    <label for="year" class="mr-2 block text-l font-medium text-gray-700 dark:text-gray-200 w-16">Year</label>
                    <input type="text" name="year" id="year" class="form-input rounded-md shadow-sm mt-1 block" />
                </div>
                <input type="submit" value="Search" class="btn-search-submit btn-custom mt-2 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700" />
            </form>
        </div>
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-3 px-6">
                            Title
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Author
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Borrowed at
                        </th>
                        <th scope="col" class="py-3 px-6">
                            Returned at
                        </th>
                        <th scope="col" class="py-3 px-6">
                        </th>
                    </tr>
                </thead>
                <tbody class="book-table">
                    
                    @foreach ($borrowed_books as $book)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 @if(isset($book['returned_at'])) returned @endif">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$book['book']->title}}</th>
                        <td class="py-4 px-6">{{$book['book']->author}}</td>
                        <td class="py-4 px-6">{{$book['borrowed_at']}}</td>
                        <td class="py-4 px-6">@if(isset($book['returned_at'])){{$book['returned_at']}}@else - @endif</td>
                        <td class="py-4 px-6">
                            @if(isset($book['returned_at']))

                            @else
                                <a href="{{ route('books.return', $book['book']->_id) }}" class="btn-custom text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Return book</a>
                            @endif
                        </td>
                    </tr> 
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>

<style>
    .returned {
        opacity: 0.5;
    }
</style>