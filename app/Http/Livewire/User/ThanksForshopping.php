<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ThanksForshopping extends Component
{
    public $orderid;

    public function mount($orderid)
    {
        $this->orderid = $orderid;
        // dd($this->orderid);
    }
    
   


    public function render()
    {

                $orderdetal = OrderDetail::where('user_id', Auth::guard('user')->user()->id)
                     ->where('order_done', '1')
                     ->where('order_id', $this->orderid)
                     ->with('getproduct')
                     ->get();



                $orders = Order::where('user_id', Auth::guard('user')->user()->id)
                     ->where('id', $this->orderid)
                     ->with('orderDetails')
                     ->get();
                    //  dd($order);

       

                    return view('livewire.user.thanks-forshopping', compact('orders','orderdetal'))
                    ->layout('layouts.master');
    }
}
