<x-app-layout>
    
    <div class="p-10">
        <div class="flex">
            @if(Auth::user()->userIsAdmin())
                <a href="{{ route('books.create') }}" class="btn-custom mb-2 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    &nbsp;
                    Add book
                </a>
            @endif
            <a href="javascript:void(0);" class="btn-search btn-custom mb-2 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>                &nbsp;
                Search
            </a>
        </div>
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
                            <div class="flex items-center">
                                Title
                                &nbsp;
                                <div class="sort sort-title-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-title-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                Author
                                &nbsp;
                                <div class="sort sort-author-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-author-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                Available
                                &nbsp;
                                <div class="sort sort-available-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-available-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            
                        </th>
                    </tr>
                </thead>
                <tbody class="book-table">
                    
                </tbody>
            </table>
        </div>
    </div>


</x-app-layout>

<style>

    .btn-custom {
        display: flex;
        align-items: center;
        max-width: fit-content;
    }

    .sort:hover {
        cursor: pointer;
    }
</style>


<script>
    $(window).on('load', function() {
        $('.btn-search').click(function() {
            $('#search-box').toggle();
        });

        searchBooks();

        $('.btn-search-submit').on('click', function(e) {
            e.preventDefault();
            var title = $('#title').val();
            var author = $('#author').val();
            var year = $('#year').val();
            
            searchBooks(title, author, year);
        });

        $('.sort-title-desc').on('click', function() {
            searchBooks(null, null, null, 'title', 'DESC');
        });

        $('.sort-title-asc').on('click', function() {
            searchBooks(null, null, null, 'title', 'ASC');
        });

        $('.sort-author-desc').on('click', function() {
            searchBooks(null, null, null, 'author', 'DESC');
        });

        $('.sort-author-asc').on('click', function() {
            searchBooks(null, null, null, 'author', 'ASC');
        });

        $('.sort-available-desc').on('click', function() {
            searchBooks(null, null, null, 'available', 'DESC');
        });

        $('.sort-available-asc').on('click', function() {
            searchBooks(null, null, null, 'available', 'ASC');
        });

        function searchBooks(title = null, author = null, year = null, sortBy = 'created_at', sortDirection = 'DESC') {
            $.ajax({
                url: '/library/get/all?author=' + author + '&title=' + title + '&year=' + year + '&sortBy=' + sortBy + '&sortDirection=' + sortDirection,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let books = data;
                    console.log(books)
                    $('.book-table').html("");
                    books.forEach(function(book) {
                        $('.book-table').append(
                            '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">' +
                            '<th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">' +
                            book.title +
                            '</th>' +
                            '<td class="py-4 px-6">' +
                            book.author +
                            '</td>' +
                            '<td class="py-4 px-6">' +
                            book.available +
                            '</td>' +
                            '<td class="py-4 px-6">' +
                            '<a href="/library/' + book._id + '" class="text-blue-500 hover:text-blue-700">Show</a>' +
                            '&nbsp;&nbsp;' +
                            '<a href="/library/' + book._id + '/edit" class="text-blue-500 hover:text-blue-700">Edit</a>' +
                            '&nbsp;&nbsp;' +
                            '<a href="/library/' + book._id + '/delete" class="text-red-500 hover:text-red-700">Delete</a>' +
                            '</td>' +
                            '</tr>'
                        );
                    });
                }
            });
        }
    
        

    });
</script>