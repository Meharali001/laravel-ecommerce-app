<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminLogin extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect()->route('admin.dashboard');
        }

        session()->flash('error', 'Invalid credentials');
    }

    public function render()
    {
        return view('livewire.auth.admin-login')->layout('layouts.auth');
    }
}

