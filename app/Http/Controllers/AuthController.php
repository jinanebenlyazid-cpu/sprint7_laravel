<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ─────────────────────────────────────────
    // GET /login
    // ─────────────────────────────────────────
    public function showLogin()
    {
        return view('login');
    }

    // ─────────────────────────────────────────
    // POST /login
    // ─────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        // Chercher l'utilisateur par login
        $user = User::where('login', $request->login)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->remember ?? false);
            return redirect(url('/'))->with('success', '👋 Bienvenue, ' . $user->prenom . ' !');
        }

        return back()->withErrors([
            'login' => 'Login ou mot de passe incorrect.',
        ])->withInput();
    }

    // ─────────────────────────────────────────
    // GET /register
    // ─────────────────────────────────────────
    public function showRegister()
    {
        return view('register');
    }

    // ─────────────────────────────────────────
    // POST /register
    // ─────────────────────────────────────────
    public function register(Request $request)
    {
        $request->validate([
            'login'    => 'required|string|unique:users,login|max:100',
            'password' => 'required|string|min:6|confirmed',
            'nom'      => 'required|string|max:100',
            'prenom'   => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'tel'      => 'required|string|unique:users,tel|max:20',
        ]);

        $user = User::create([
            'login'    => $request->login,
            'password' => Hash::make($request->password),
            'nom'      => $request->nom,
            'prenom'   => $request->prenom,
            'email'    => $request->email,
            'tel'      => $request->tel,
            'role'     => 'USER',
        ]);

        Auth::login($user);

        return redirect(url('/'))->with('success', '🎉 Compte créé avec succès ! Bienvenue, ' . $user->prenom . ' !');
    }

    // ─────────────────────────────────────────
    // POST /logout
    // ─────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(url('/login'))->with('success', '👋 Vous êtes déconnecté.');
    }
}