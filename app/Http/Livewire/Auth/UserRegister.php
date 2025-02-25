<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserRegister extends Component
{
    public $name, $email, $password, $password_confirmation;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ];

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        Auth::login($user);

        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.user-register')->layout('layouts.auth');
    }
}
