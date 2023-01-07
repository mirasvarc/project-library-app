<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->pid = $request->pid;
        $user->address = $request->address;
        $user->approved = 0;
        $user->is_admin = 0;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $borrowed_books = $user->borrowedBooks();
        return view('profile.detail', ['user' => $user, 'borrowed_books' => $borrowed_books]);
    }

    public function showMyLibrary() {
        $user = Auth::user();
        $borrowed_books = $user->borrowedBooks();
     
        return view('my_library.mybooks', ['user' => $user, 'borrowed_books' => $borrowed_books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', ['user' => $user]);
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
        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->pid = $request->pid;
        $user->address = $request->address;
        $user->approved = 0;
        $user->is_admin = 0;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index');
    }


    public function getAllUsers() {

        $firstname  = null;
        $lastname = null;
        $pid   = null;
        $address = null;

        if(strlen(request('firstname')) > 3) {
            $firstname = request('firstname');
        }
        if(strlen(request('lastname')) > 3) {
            $lastname = request('lastname');
        }
        if(strlen(request('address')) > 3) {
            $address = request('address');
        }
        if(strlen(request('pid')) > 3) {
            $pid = request('pid');
        }


        if(($firstname == null && $lastname == null && $pid == null && $address == null) || ($firstname == 'null' && $lastname == 'null' && $pid == 'null' && $address == 'null')) {
            $users = User::orderBy(request('sortBy'), request('sortDirection'))->get();
        } else {
            $users = User::select('id', 'firstname', 'lastname', 'address', 'pid', 'created_at')
                        ->when($firstname, function($query, $firstname) {
                            return $query->where('firstname', 'like', '%'.$firstname.'%');
                        })
                        ->when($lastname, function($query, $lastname) {
                            return $query->where('lastname', 'like', '%'.$lastname.'%');
                        })
                        ->when($address, function($query, $address) {
                            return $query->where('address', 'like', '%'.$address.'%');
                        })
                        ->when($pid, function($query, $pid) {
                            return $query->where('pid', 'like', '%'.$pid.'%');
                        })
                        ->orderBy(request('sortBy'), request('sortDirection'))
                        ->get();
        }

        return json_encode($users);
    }

    public function approveUser($id) {
        $user = User::find($id);
        $user->approved = 1;
        $user->save();
        return redirect()->back();
    }

    public function blockUser($id) {
        $user = User::find($id);
        $user->approved = 0;
        $user->save();
        return redirect()->back();
    }
}
