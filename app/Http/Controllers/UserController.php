<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cursouser;
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
        $admin = Auth::user();
        if($admin->perm != 0 && $admin->perm != 3){
            return redirect('/');
        }
        $user = Auth::user();
        $notas = Cursouser::where('user_id','=',$user->id)->get();

        $cursospart = $user->cursos;
        return view('users.index',['cursospart' => $cursospart,'notas' => $notas,'user' => $user]);
    }

    public function show($id)
    {
        $admin = Auth::user();
        if($admin->perm != 0 && $admin->perm != 1 && $admin->perm != 3){
            return redirect('/');
        }
        user::findOrFail($id);
        $user = Auth::user();
        return view('users.show',['user' => $user]);
    }

    public function edit($id)
    {
        $admin = Auth::user();
        if($admin->id != $id && $admin->perm != 2 && $admin->perm != 3){
            return redirect('/');
        }
        $user = user::findOrFail($id);
        
        
        return view('users.edit',['user' => $user]) ;
    }

    public function update($id,Request $request)
    {
        $admin = Auth::user();
        if($admin->id != $id && $admin->perm != 2 && $admin->perm != 3){
            return redirect('/');
        }

        $cpf = $request->CPF;
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
	    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
        if (strlen($cpf) != 11) {
            return back()->with("erro", "CPF inválido");
        }
        else if ($cpf == '00000000000' || 
		$cpf == '11111111111' || 
		$cpf == '22222222222' || 
		$cpf == '33333333333' || 
		$cpf == '44444444444' || 
		$cpf == '55555555555' || 
		$cpf == '66666666666' || 
		$cpf == '77777777777' || 
		$cpf == '88888888888' || 
		$cpf == '99999999999') {
        return back()->with("erro", "CPF inválido");
	 // Calcula os digitos verificadores para verificar se o
	 // CPF é válido
	    } else {   
		
		for ($t = 9; $t < 11; $t++) {
			
			for ($d = 0, $c = 0; $c < $t; $c++) {
				$d += $cpf[$c] * (($t + 1) - $c);
			}
			$d = ((10 * $d) % 11) % 10;
			if ($cpf[$c] != $d) {
				return back()->with("erro", "CPF inválido");
			}
		}
        }
        if(is_numeric($request->num) != 1 || $request->num<0){
            return back()->with("erro", "Número da residência inválido");
        }

        $user = user::findOrFail($request->id);
        if($user->perm == 0){
            $request->validate([
                'name' => ['required', 'string', 'max:120'],
                'email' => ['required', 'string', 'email', 'max:50'],
                'endereco' => ['required','string', 'max:8'],
                'num' => ['required'],
                'filme' => ['required', 'string', 'max:80'],
                'username' => ['required','string','max:30'],
            ]);
        $user = user::findOrFail($request->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'CPF' => $request->CPF,
            'endereco' => $request->endereco,
            'num' => $request->num,
            'filme' => $request->filme,
        ]);
        }
        else{
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'CPF' => ['required','string'],
                'endereco' => ['required', 'string', 'max:8'],
                'num' => ['required'],
                'username' => ['required','string','max:50'],
            ]);
            $user = user::findOrFail($request->id)->update([
                'name' => $request->name,
                'username' => $request->username,
                'CPF' => $request->CPF,
                'endereco' => $request->endereco,
                'num' => $request->num,
                'imagem' => $request->imagem
            ]);
        }


        if($admin->perm == 1){
            return redirect ('/professor')->with("status",'Dados alterados com sucesso');
        }

        if($admin->perm == 2){
            return back()->with("status", "Dados alterados com sucesso");
        }
        return redirect('/home')->with("status",'Dados alterados com sucesso');

    }

    public function editpassword($id)
    {
        $admin = Auth::user();
        if($admin->id != $id && $admin->perm != 3){
            return redirect('/');
        }
        $user = user::findOrFail($id);
        
        return view('users.editpassword',['user' => $user]) ;
    }

    public function updatepassword(Request $request,$id)
    {
        $admin = Auth::user();
        if($admin->id != $id){
            return redirect('/');
        }
        $request->validate([
            'antigopassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);
        if(!hash::check($request->antigopassword,auth()->user()->password)){
            return back()->with("erro", "ERRO: Senha incorreta");
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        if($admin->perm == 2){
            return redirect('/admin')->with("status",'Senha alterada com sucesso');
        }
        elseif($admin->perm == 1){
            return redirect('/professor')->with("status",'Senha alterada com sucesso');
        }
        else{
            return redirect('/home')->with("status",'Senha alterada com sucesso');
        }



        
    }
}
