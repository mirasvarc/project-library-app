<x-app-layout>

    <div class="p-10">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 text-blue-600 hover:text-blue-600 dark:text-blue-500 dark:hover:text-blue-500 border-blue-600 dark:border-blue-500" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                        Profile
                    </button>
                </li>
                <li class="mr-2" role="presentation">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 dark:border-transparent text-gray-500 dark:text-gray-400 border-gray-100 dark:border-gray-700" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                        My books
                    </button>
                </li>
                
            </ul>
        </div>
        <div id="myTabContent">
            <div class="p-4 bg-gray-50 rounded-lg dark:bg-gray-800 flex justify-between" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <table class="w-50 text-sm text-left text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-3 px-6">
                                Full name
                            </td>
                            <td class="py-3 px-6">
                                {{$user->firstname}} {{$user->lastname}}
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-3 px-6">
                                Username
                            </td>
                            <td class="py-3 px-6">
                                {{$user->username}}
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-3 px-6">
                                Email
                            </td>
                            <td class="py-3 px-6">
                                {{$user->email}}
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-3 px-6">
                                Personal ID
                            </td>
                            <td class="py-3 px-6">
                                {{$user->pid}}
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-3 px-6">
                                Address
                            </td>
                            <td class="py-3 px-6">
                                {{$user->address}}
                            </td>
                        </tr>
                        @if(Auth::user()->is_admin)
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-3 px-6">
                                Role
                            </td>
                            <td class="py-3 px-6">
                                @if($user->is_admin) Librarian @else User @endif
                            </td>
                        </tr>
                        <tr class="border-b border-gray-200 dark:border-gray-700">
                            <td class="py-3 px-6">
                                Approved
                            </td>
                            <td class="py-3 px-6">
                                @if($user->approved) Yes @else No @endif
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <div class="ml-5 mt-2">
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('users.edit', $user->_id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit User</a>
                        @if($user->approved == 0)
                            <a href="/users/{{$user->_id}}/approve" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve User</a>
                        @else 
                            <a href="/users/{{$user->_id}}/block" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Block User</a>
                        @endif 
                    @else
                        <a href="{{ route('users.edit', $user->_id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit profile</a>
                    @endif
                </div>
            </div>
            <div class="hidden p-4 bg-gray-50 rounded-lg dark:bg-gray-800" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                <p class="text-sm text-gray-500 dark:text-gray-400">
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
                </p>
            </div>
            
        </div>
    </div>



</x-app-layout>