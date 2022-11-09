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
            // if(!Auth::user()->etat){
            //     return redirect()->route('unauthorization');
            // }
            session()->regenerate();
            $user = Auth::user();
            if ($user->profil == 'superadmin') {
                return redirect()->route('accueil');
            } else if ($user->profil == 'customer') {
                return redirect('/');
            } else if ($user->profil == 'visiteur') {
                dd('Vous etes un utilisateur');
            }
        } else {
            Session::flash('message','Email ou mot de passe Incorrect');
            Session::flash('class-alert','alert-danger');
            return back();
        }
    }
}
