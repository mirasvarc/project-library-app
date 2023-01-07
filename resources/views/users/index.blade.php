<x-app-layout>
    
    <div class="p-10">
        <div class="flex">
            @if(Auth::user()->userIsAdmin())
                <a href="{{ route('users.create') }}" class="btn-custom mb-2 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="inline flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    &nbsp;
                    Create new user
                </a>
            @endif
            <a href="javascript:void(0);" class="btn-search btn-custom mb-2 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>                &nbsp;
                Search
            </a>
        </div>
        <div id="search-box" class="mt-2 mb-10" style="display: none;">
            <form>
                <p class="text-xl font-medium text-gray-700 dark:text-gray-200 mb-5">Search user:</p>
                <div class="flex items-center">
                    <label for="firstname" class="mr-3 block text-l font-medium text-gray-700 dark:text-gray-200 w-24">Firstname</label>
                    <input type="text" name="firstname" id="firstname" class="form-input rounded-md shadow-sm mt-1 block" />
                </div>
                <div class="flex items-center">
                    <label for="lastname" class="mr-3 block text-l font-medium text-gray-700 dark:text-gray-200 w-24">Lastname</label>
                    <input type="text" name="lastname" id="lastname" class="form-input rounded-md shadow-sm mt-1 block" />
                </div>
                <div class="flex items-center">
                    <label for="address" class="mr-3 block text-l font-medium text-gray-700 dark:text-gray-200 w-24">Address</label>
                    <input type="text" name="address" id="address" class="form-input rounded-md shadow-sm mt-1 block" />
                </div>
                <div class="flex items-center">
                    <label for="pid" class="mr-3 block text-l font-medium text-gray-700 dark:text-gray-200 w-24">Personal ID</label>
                    <input type="text" name="pid" id="pid" class="form-input rounded-md shadow-sm mt-1 block" />
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
                                Name
                                &nbsp;
                                <div class="sort sort-name-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-name-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                Username
                                &nbsp;
                                <div class="sort sort-username-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-username-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                Email
                                &nbsp;
                                <div class="sort sort-email-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-email-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                Personal ID
                                &nbsp;
                                <div class="sort sort-pid-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-pid-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            <div class="flex items-center">
                                Address
                                &nbsp;
                                <div class="sort sort-add-desc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                </div>
                                <div class="sort sort-add-asc">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up"><polyline points="18 15 12 9 6 15"></polyline></svg>
                                </div>
                            </div>
                        </th>
                        <th scope="col" class="py-3 px-6">
                            
                        </th>
                    </tr>
                </thead>
                <tbody class="user-table">
                    
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

        searchUsers();

        $('.btn-search-submit').on('click', function(e) {
            e.preventDefault();
            let firstname = $('#firstname').val();
            let lastname = $('#lastname').val();
            let address = $('#address').val();
            let pid = $('#pid').val();
            
            searchUsers(firstname, lastname, address, pid);
        });

        $('.sort-name-desc').on('click', function() {
            searchUsers(null, null, null, null, 'lastname', 'DESC');
        });

        $('.sort-name-asc').on('click', function() {
            searchUsers(null, null, null, null, 'lastname', 'ASC');
        });

        $('.sort-email-desc').on('click', function() {
            searchUsers(null, null, null, null, 'email', 'DESC');
        });

        $('.sort-email-asc').on('click', function() {
            searchUsers(null, null, null, null, 'email', 'ASC');
        });

        $('.sort-pid-desc').on('click', function() {
            searchUsers(null, null, null, null, 'pid', 'DESC');
        });

        $('.sort-pid-asc').on('click', function() {
            searchUsers(null, null, null, null, 'pid', 'ASC');
        });

        $('.sort-add-desc').on('click', function() {
            searchUsers(null, null, null, null, 'address', 'DESC');
        });

        $('.sort-add-asc').on('click', function() {
            searchUsers(null, null, null, null, 'address', 'ASC');
        });




        function searchUsers(firstname = null, lastname = null, address = null, pid = null, sortBy = 'created_at', sortDirection = 'DESC') {
            $.ajax({
                url: '/users/get/all?firstname=' + firstname + '&lastname=' + lastname + '&address=' + address + '&pid=' + pid + '&sortBy=' + sortBy + '&sortDirection=' + sortDirection,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    let users = data;
                    console.log(users)
                    $('.user-table').html("");
                    users.forEach(function(user) {
                        $('.user-table').append(
                            '<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">' +
                            '<th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">' +
                                user.firstname + ' ' + user.lastname +
                            '</th>' +
                            '<td class="py-4 px-6">' +
                                user.username +
                            '</td>' +
                            '<td class="py-4 px-6">' +
                                user.email +
                            '</td>' +
                            '<td class="py-4 px-6">' +
                                user.pid +
                            '</td>' +
                            '<td class="py-4 px-6">' +
                                user.address +
                            '</td>' +
                            '<td class="py-4 px-6">' +
                            '<a href="/users/' + user._id + '" class="text-blue-500 hover:text-blue-700">Show</a>' +
                            '&nbsp;&nbsp;' +
                            '<a href="/users/' + user._id + '/edit" class="text-blue-500 hover:text-blue-700">Edit</a>' +
                            '</td>' +
                            '</tr>'
                        );
                    });
                }
            });
        }
    
        

    });
</script>