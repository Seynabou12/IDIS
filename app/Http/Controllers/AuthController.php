<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function formLogin()
    {

        return view('auth.login');
        
    }

    public function login(Request $request)
    {
        $tab = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::attempt($tab, $request->all())) {
            session()->regenerate();
            $user = Auth::user();
            if ($user->profil == 'superadmin') {
                return redirect()->route('dashbord');
            } else if ($user->profil == 'customer') {
                return redirect('/welcom');
            } else if ($user->profil == 'visiteur') {
                dd('Vous etes un utilisateur');
            }
        } else {
            Session::flash('message','Adresse Email ou Mot de Passe Incorrect');
            Session::flash('class-alert','alert-danger');
            return back();
        }
    }
}
