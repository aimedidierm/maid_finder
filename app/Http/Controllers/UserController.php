<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::find(Auth::id());
        if ($user->role == 'admin') {
            return view('admin.settings', ['data' => $user]);
        } else {
            return view('employer.settings', ['data' => $user]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
            'confirmPassword' => 'required|string',
        ]);

        if ($request->password == $request->confirmPassword) {
            $user = new User;
            $user->name = $request->name;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->role = 'employer';
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('/');
        } else {
            return redirect('/')->withErrors('Passwords not match');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'password' => 'required|string',
            'confirmPassword' => 'required|string'
        ]);
        $user = User::find(Auth::id());
        if ($request->password == $request->confirmPassword) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            return redirect('/employer/settings');
        } else {
            return back()->withErrors('Passwords not match');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
