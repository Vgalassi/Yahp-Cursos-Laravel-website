<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfController extends Controller
{
    public function index(){
        $admin = Auth::user();
        if($admin->perm != 1){
            return redirect('/');
        }
        return view('profs.index');
    }

    public function edit($id)
    {
        $admin = Auth::user();
        if($admin->perm != 1){
            return redirect('/');
        }
        user::findOrFail($id);
        $user = Auth::user();
        
        return view('profs.edit',['user' => $user]) ;
    }
}
