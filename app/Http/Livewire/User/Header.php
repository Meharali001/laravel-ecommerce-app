<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use App\Models\OrderDetail;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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

        // $carts = OrderDetail::where('user_id', Auth::guard('user')->user()->id)
        // ->where('order_done', '0')
        // ->get();

        $carts = Session::get('cart', []);
        // dd($carts);

        return view('livewire.user.header', compact('carts'));
    }
}
