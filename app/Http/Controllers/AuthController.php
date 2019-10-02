<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $usuario = User::where("email", $request->email)->first();

            Auth::login($usuario);

            $datosUsurio = ["nombre" => $usuario->name, "tipo" => $usuario->type];

            return response()->json(['login' => true, 'usuario' => $datosUsurio]);

        } else {

            return response()->json(['login' => false]);

        }

    }

    public function check()
    {

        if (Auth::check()) {

            $email = Auth::user()->email;

            $usuario = User::where("email", $email)->first();

            $datosUsurio = ["nombre" => $usuario->name, "tipo" => $usuario->type];

            return response()->json(['login' => true, 'usuario' => $datosUsurio]);

        } else {

            return response()->json(['login' => false]);
        }
    }

    public function logout()
    {

        Auth::logout();
        return view('home');

    }

}
