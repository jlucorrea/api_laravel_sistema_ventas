<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginFormRequest;
use App\Http\Resources\UsuarioCollection;

class UsuarioController extends Controller
{

    public function index()
    {
        $usuario = User::where('estado', 1)->get();
		return new UsuarioCollection($usuario);
    }

    public function store(Request $request)
    {
		$this->validate($request, [
			'nombre' => 'required',
			'username' => 'required',
			'email' => 'required'
		]);
		$id = $request->input('id');
		$usuario = User::firstOrNew(['id' => $id]);
		$usuario->nombre = $request->input('nombre');
		$usuario->username = $request->input('username');
		$usuario->email = $request->input('email');

		if($id){
			$usuario->password = !empty($request->input('password')) ? bcrypt($request->input('password')) : $usuario->password;
		}else{
			$usuario->password = bcrypt($request->input('password'));
		}

		$usuario->save();

		return response()->json([
			'success' => true,
			'message' => !$id ? 'Registro Exitoso' : 'Registro Actualizado'
		]);
    }

    public function show(User $usuario)
	{
		$usuario->caja = $usuario->caja;
        return $usuario;
    }
	
    public function destroy(User $usuario)
    {
		$usuario->update([
			'estado' => 0
		]);
		return response()->json([
			'success' => true,
			'message' => 'Registro Eliminado'
		]);
    }

	public function login(LoginFormRequest $request)
    {
		if(Auth::attempt(['email' => $request->email, 'password' => $request->password],false)){
			$usuario = Auth::user();
			$usuario->caja = $usuario->caja;
			return $usuario;
		}else{
			return response()->json(['errors' => ['login' => 'Los datos no son validos']]);
		}
    }
}