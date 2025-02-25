<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Header extends Component
{

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.login');
    }

    public function render()
    {

        $carts = Cart::where('user_id', Auth::guard('user')->user()->id)->get();


        return view('livewire.user.header', compact('carts'));
    }
}
