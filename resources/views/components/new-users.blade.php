@php
    $new_users = App\Models\User::where('approved', 0)->get();  
@endphp

<h1 class="p-4 text-3xl font-semibold tracking-tight text-gray-900 dark:text-white">Users to approve</h1>
<div class="flex">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Name
                </th>
                <th scope="col" class="py-3 px-6">
                    Username
                </th>
                <th scope="col" class="py-3 px-6">
                    Email
                </th>
                <th scope="col" class="py-3 px-6">
                    Personal ID
                </th>
                <th scope="col" class="py-3 px-6">
                    Address
                </th>
                <th scope="col" class="py-3 px-6">
                    
                </th>
            </tr>
        </thead>
        <tbody class="user-table">
            @foreach($new_users as $user)
                <tr class="border-b border-gray-200 dark:border-gray-700">
                    <td class="py-3 px-6">
                        {{ $user->firstname }} {{ $user->lastname }}
                    </td>
                    <td class="py-3 px-6">
                        {{ $user->username }}
                    </td>
                    <td class="py-3 px-6">
                        {{ $user->email }}
                    </td>
                    <td class="py-3 px-6">
                        {{ $user->pid }}
                    </td>
                    <td class="py-3 px-6">
                        {{ $user->address }}
                    </td>
                    <td class="py-3 px-6">
                        <a href="/users/{{$user->_id}}/approve" class="w-32 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="ml-2">Approve</span>
                        </a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
