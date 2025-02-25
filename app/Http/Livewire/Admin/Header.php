<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
class Header extends Component
{
    use WithFileUploads;
    protected $listeners = ['refreshHeaderImage' => '$refresh']; 

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function render()  
    {
        $admin = Auth::guard('admin')->user();
        
        return view('livewire.admin.header', compact('admin'));
    }
}
