<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request) {
        $payload = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if(auth()->attempt(['name' => $payload['loginname'], 'password' => $payload['loginpassword']])) {
            $request->session()->regenerate();
        }
        return redirect('/');
    }

    public function register(Request $request) {
        $payload = $request->validate([
            'name' => ['required', 'min:3', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:6']
        ]);

        $payload['password'] = bcrypt($payload['password']);
        $user = User::create($payload);
        auth()->login($user);
       return $user;
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
