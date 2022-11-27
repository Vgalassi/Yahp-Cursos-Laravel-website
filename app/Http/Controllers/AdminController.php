<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Curso;
use App\Models\Cursouser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $admin = Auth::user();
        if($admin->perm != 2 && $admin->perm != 3){
            return redirect('/');
        }
        
        $cursos = Curso::all();
        $users = User::all();


        return view('admin.index',['cursos' => $cursos, 'users' => $users]);
    }

    public function create(){
        $admin = Auth::user();
        if($admin->perm != 2 && $admin->perm != 3){
            return redirect('/');
        }
        return view('auth.register');
    }
    

    public function create_alu( Request $request){

        $admin = Auth::user();
        if($admin->perm != 2 && $admin->perm != 3){
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


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255','unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'CPF' => ['required','string','unique:users'],
            'cep' => ['required','string', 'max:8'],
            'filme' => ['required', 'string', 'max:255'],
            'username' => ['required','string','max:50','unique:users'],
        ]);

        $user = new user;

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->CPF = $request->CPF;
        $user->endereco = $request->cep;
        $user->filme = $request->filme;
        


        $user->perm = 0;

        $user->save();
        return back()->with("status", "Aluno " .$user->username. ' adicionado com sucesso!');

   }

   public function create_prof( Request $request){

    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
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

    $request->validate([
        'profname' => ['required', 'string', 'max:255'],
        'password' => ['required', 'string', 'min:8','confirmed'],
        'CPF' => ['required','string','unique:users'],
        'pcep' => ['required', 'string', 'max:8'],
        'username' => ['required','string','max:50','unique:users'],
    ]);
    $user = new user;

    $user->imagem = $request->profimagem;
    $user->name = $request->profname;
    $user->username = $request->username;
    $user->password = hash::make($request->password);
    $user->CPF = $request->CPF;
    $user->endereco = $request->pcep;
    $user->filme = 'N/A';
    $user ->email = 'N/A';

    $user->perm = 1;

    $user->save();
    return back()->with("status", "Professor " .$user->username. ' adicionado com sucesso!');
}

public function create_curso( Request $request){

    
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect('/');
    }

    if($request->maxalu < $request->minalu){
        return back()->with('erro','ERRO: mínimo de alunos maior do que máximo de alunos');}

    if(is_numeric($request->minalu) != 1 || is_numeric($request->maxalu) != 1 ){
        return back()->with('erro','ERRO: digite um número válido para o número de alunos');
    }

    $curso = new curso;

    $curso->name = $request->namecurso;
    $curso->descrisimp = $request->descrisimp;
    $curso->descricomp = $request->descricomp;
    $curso->maxalu = $request->maxalu;
    $curso->minalu = $request->minalu;
    $curso->imagem = $request->cursoimagem;

    if($curso->minalu != 0){
       $curso->status = 0;
    }
    elseif($curso->maxalu == 0){
        $curso->status == 2;
    }
    else{
    $curso->status = 1;}

    $curso->save();
    return back()->with("status", "Curso " .$curso->name. ' adicionado com sucesso!');

}

public function show_curso($id){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect('/');
    }

    $curso = Curso::findOrfail($id);
    $notas = Cursouser::where('curso_id', '=',$id )->get();
    $soma = 0;
    $reprovado = 0;
    $aprovado = 0;
    $reprovadop = 0;
    $aprovadop = 0;
    foreach ($notas as $nota){
        $soma = $soma + $nota->nota;
        if($nota->nota >= 5){
            $aprovado = $aprovado + 1;
        }
        else{
            $reprovado = $reprovado + 1;
        }
    }
    if(count($notas) != 0){
        $media = $soma/count($notas);
        $aprovadop = ($aprovado/count($notas)) * 100;
        $reprovadop = ($reprovado/count($notas)) * 100;
    }
    else{
        $media = NULL;
    }
    $users= User::where('perm', '=', 0)->Orwhere('perm', '=', 3)->get();
    $professores = User::where('perm', '=', 1)->get();
    $professor = User::find($curso->user_id);

    return view('admin.show',['curso' => $curso,'users' =>$users,'professor' => $professor,'media' => $media,
    'notas'=> $notas,'aprovado' => $aprovado,'reprovado' => $reprovado,'aprovadop' => $aprovadop,'reprovadop' => $reprovadop,'professores' => $professores]);
    
}
public function delete_user($id){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect('/');
    }
    User::findOrFail($id)->delete();

    return back()->with("status", "Usuário excluído com sucesso!");

}

public function delete_curso($id){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect('/');
    }
    Curso::findOrFail($id)->delete();

    return back()->with("status", "Curso excluído com sucesso!");

}

public function linkprof(){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect('/');
    }
    $users = User::all();
    $cursos = Curso::all();

    return view('admin.linkprof',[ 'cursos' => $cursos, 'users' => $users]);
}

public function attachprof(Request $request){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect('/');
    }
    $curso = curso::findOrFail($request->cursoid);
    $user = user::findOrFail($request->profid);
    $curso->user_id = $user->id;
    $curso->save();
    return back()->with("status","Professor " .$user->name. ' relacionado com ' .$curso->name );
    
}

public function dettachprof($id){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect('/');
    }
    
    $curso = Curso::findOrFail($id);
    $user = User::findOrFail($curso->user_id);
    $curso->user_id = NULL;
    $curso->save();
    return back()->with("status","Professor " .$user->name. ' desatribuído de ' .$curso->name );
}

public function join(Request $request,$id){
    $admin = Auth::user();

    if($admin->perm != 2 && $admin->perm != 3){
        return redirect ('/cursos');
    }
    $curso = curso::findOrfail($id);
    if($curso->status == 2 || $curso->status == 3){
        return back()->with('erro','ERRO: Matrículas fechadas!');
    }
    $user = User::findOrfail($request->alunoid);

    $cursosusuario = $user->cursos->toArray();
    foreach ($cursosusuario as $cursousuario){
        if($cursousuario['id'] == $id){
            return back()->with('erro','Aluno já está no curso');
        } 
    }
    $user->cursos()->attach($id);

    $curso = curso::findOrfail($id);

    $alunos = User::where('perm', '=', 0)->Orwhere('perm', '=', 3)->get();
    $count = 0;

    foreach($alunos as $aluno){
        foreach($aluno->cursos as $cursoalu){
            if($cursoalu->id == $curso->id){
                $count = $count + 1;
            }
        }
    }

    if($count < $curso->minalu ){
        $curso->status = 0;
       }
       elseif($count >= $curso->maxalu){
           $curso->status = 2;
       }
       else{
           $curso->status = 1;
       }
       $curso->save();
    

    return back()->with('status','Aluno ' . $user->name . ' matriculado com sucesso em: ' . $curso->name);
}

public function edit_curso($id){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect ('/cursos');
    }
    $curso = Curso::findOrFail($id);

    return view('admin.edit',['curso' => $curso]);
}

public function update_curso($id,Request $request){
    $admin = Auth::user();
    if($admin->perm != 2 && $admin->perm != 3){
        return redirect ('/cursos');
    }
    if($request->maxalu < $request->minalu){
        return back()->with('erro','ERRO: mínimo de alunos maior do que máximo de alunos');}

    if(is_numeric($request->minalu) != 1 || is_numeric($request->maxaul) != 1 ){
        return back()->with('erro','ERRO: digite um número válido para o número de alunos');
    }

    $alunos = User::where('perm', '=', 0)->Orwhere('perm', '=', 3)->get();
    $curso = Curso::findOrfail($id);
    $count = 0;
    foreach($alunos as $aluno){
        foreach($aluno->cursos as $cursoalu){
            if($cursoalu->id == $curso->id){
                $count = $count + 1;
            }
        }
    }

    Curso::findOrfail($id)->update($request->all());
    $curso = Curso::findOrfail($id);

    if($curso->status != 3){
    if($count < $curso->minalu ){
     $curso->status = 0;
    }
    elseif($count >= $curso->maxalu){
        $curso->status = 2;
    }
    else{
        $curso->status = 1;
    }
}
    
    $curso->save();
    return back()->with("status", "Dados alterados com sucesso");

}
    public function close($id){
        $admin = Auth::user();
        if($admin->perm != 2 && $admin->perm != 3){
            return redirect ('/cursos');
        }

        $curso = Curso::findOrfail($id);
        $curso->status = 3;
        $curso->save();

        return back()->with("status", "Curso fechado com sucesso");
    }

    public function open($id){
        $admin = Auth::user();
        if($admin->perm != 2){
            return redirect ('/cursos');
        }

    $alunos = User::where('perm', '=', 0)->get();
    $curso = Curso::findOrfail($id);
    $count = 0;
    foreach($alunos as $aluno){
        foreach($aluno->cursos as $cursoalu){
            if($cursoalu->id == $curso->id){
                $count = $count + 1;
            }
        }
    }

    if($count < $curso->minalu ){
        $curso->status = 0;
       }
    elseif($count >= $curso->maxalu){
        $curso->status = 2;
    }
    else{
        $curso->status = 1;
    }

        
    $curso->save();

        return back()->with("status", "Fechamento forçado cancelado com sucesso!");
    }

    public function user_password($id){
        $admin = Auth::user();
        if($admin->perm != 2 && $admin->perm != 3){
            return redirect('/');
        }
        $user = User::findOrfail($id);
        return view('admin.password',['user' => $user]);

    }

    public function upuser_password($id,Request $request){
        $admin = Auth::user();
        if($admin->perm != 2 && $admin->perm != 3){
            return redirect('/');
        }
        $request->validate([
            'password' => 'required|confirmed',
        ]);
        User::findOrfail($id)->update([
            'password' => Hash::make($request->password)
        ]);
        $user = User::findOrfail($id);
        return redirect('/admin')->with("status",'Senha de ' .$user->name . 'alterada com sucesso');
        
    }

    public function beprofessor($id){
        $admin = Auth::user();
        if($admin->perm != 3){
            return redirect('/');
        }

        $curso = Curso::findOrfail($id);
        $curso->user_id = $admin->id;
        $curso->save();

        return back()->with("status",'Se tornou professor de ' . $curso->name . 'com sucesso');



    }


}
