<?php

namespace App\Http\Livewire\Auth;

// namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('user')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('user.dashboard'); // Redirect to Dashboard
        }
    
        session()->flash('error', 'Invalid credentials');
    
    }

    public function render()
    {
        return view('livewire.auth.user-login')->layout('layouts.auth');
    }
}
