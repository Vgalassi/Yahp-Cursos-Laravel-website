<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    
    public function index()
    {
        $user = Auth::user();

        $cursospart = $user->cursos;
        return view('users.index',['cursospart' => $cursospart]);
    }

    public function show($id)
    {
        user::findOrFail($id);
        $user = Auth::user();
        return view('users.show',['user' => $user]);
    }

    public function edit($id)
    {
        user::findOrFail($id);
        $user = Auth::user();
        
        return view('users.edit',['user' => $user]) ;
    }

    public function update(Request $request)
    {
        user::findOrFail($request->id)->update($request->all());
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect('/home');

    }
}
